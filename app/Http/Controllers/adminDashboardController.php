<?php

namespace App\Http\Controllers;

use App\activeLogAdmins;
use App\MemberType;
use App\notice;
use App\sms;
use App\unites;
use App\User;
use App\UserAccount;
use App\UserAddressInfo;
use App\UserBecaDetails;
use App\UserCadetDetails;
use App\UserContactInfo;
use App\UserEducationProfession;
use App\UserPaymentDetails;
use App\UserPersonalInfo;
use App\UserVerificationDoc;
use App\Withdraw;
use Illuminate\Http\Request;
use DB;

class adminDashboardController extends Controller
{
    public function admin_check($admin_type){
        if($admin_type == 'super' || $admin_type == 'author'){
            return true;
        }
        return false;
    }
    public function index(Request $request)
    {
        $admin_check = $this->admin_check($request->session()->get('admin_type'));
        $data = DB::table('user_accounts')
            ->join('user_beca_details','user_beca_details.user_id','=','user_accounts.id');
        $paymen_data = DB::table('user_accounts')
            ->join('user_beca_details','user_beca_details.user_id','=','user_accounts.id')
            ->join('user_payment_details','user_payment_details.user_id','=','user_accounts.id');
        $sms_count = sms::all()->count();
        $admin_count = User::where('user_type','!=','author')->count();
        if(!$admin_check){
            $data->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $paymen_data->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $sms_count = sms::where('send_by',$request->session()->get('admin_id'))->count();
            $admin_count = 'not_approve';
        }
        $count_all_member = $data->where('user_accounts.check','!=','0')->count();
        $count_payment = $paymen_data->sum('user_payment_details.payment_amount');
        $notice_count = notice::all()->count();
        $active_logs = 'not_approve';
        $active_logs_admins = '';
        if( $admin_check){
            $active_logs_data = DB::table('active_log_admins')
                ->join('users as admin','admin.id','=','active_log_admins.action_admin_id')
                ->leftJoin('user_personal_infos', function ($join) {
                    $join->on('user_personal_infos.user_id', '=', 'active_log_admins.action_user_id')
                        ->where('active_log_admins.user_type', '=', 'user');
                })
                ->leftJoin('unites', function ($join) {
                    $join->on('unites.id', '=', 'active_log_admins.action_user_id')
                        ->where('active_log_admins.user_type', '=', 'unite');
                })
                ->leftJoin('users', function ($join) {
                    $join->on('users.id', '=', 'active_log_admins.action_user_id')
                        ->where('active_log_admins.user_type', '=', 'admin');
                })
                ->leftJoin('member_types', function ($join) {
                    $join->on('member_types.id', '=', 'active_log_admins.action_user_id')
                        ->where('active_log_admins.user_type', '=', 'member_type');
                })
                ->where('admin.user_type','!=','author')
                ->select('admin.name as admin_name','users.name as user_name',
                    'member_types.type_name','user_personal_infos.name as member_name',
                    'unites.unite_name','active_log_admins.action_details',
                    'active_log_admins.user_type','active_log_admins.action_user_id',
                    'active_log_admins.created_at','active_log_admins.action_admin_id')
                ->orderBy('active_log_admins.id', 'DESC');
            if($request->has('active_log')){
                $active_logs_data->where('active_log_admins.action_admin_id','=',$request->active_log);
                $active_logs = $active_logs_data->paginate(10)->appends('active_log',$request->active_log);
            }else{
                $active_logs = $active_logs_data->paginate(10);
            }

            $active_logs_admins = DB::table('active_log_admins')
                ->join('users as admin','admin.id','=','active_log_admins.action_admin_id')
                ->where('admin.user_type','!=','author')
                ->select('admin.name as admin_name','active_log_admins.id','active_log_admins.action_admin_id')
                ->orderBy('active_log_admins.id', 'DESC')
                ->distinct('active_log_admins.action_admin_id')
                ->get();
        }

        return view('admin-panel.dashboard.dashboard',[
            'count_all_number'=>$count_all_member,
            'count_payment'=>$count_payment,
            'notice_count'=>$notice_count,
            'sms_count'=>$sms_count,
            'admin_count'=>$admin_count,
            'active_logs'=>$active_logs,
            'active_logs_admins' =>$active_logs_admins,
        ]);
    }
    public function admins(Request $request)
    {
        $admin_type = $request->session()->get('admin_type');

        if(($admin_type != 'super' && $admin_type != 'author') || empty($admin_type)){
            return redirect('admin_panel/login');
        }
        $admins_data = DB::table('users')
            ->join('unites','users.unite_id','=','unites.id')
            ->select('users.*','unites.unite_name')
            ->where('users.id','!=',$request->session()->get('admin_id'))
            ->where('users.user_type','!=','author');

//        $count_unites = unites::count();
        if($request->has('filter') && $request->filter != 'trash'){
            $admins = $admins_data->where('users.user_type','=',$request->filter)
                ->where('users.status','!=',2)
                ->paginate(10)->appends('filter',$request->filter);
        }elseif($request->has('filter') && $request->filter == 'trash'){
            $admins = $admins_data->where('users.status','=',2)
                ->paginate(10)->appends('filter',$request->filter);
        }else{
            $admins = $admins_data->where('users.status','!=',2)
                ->paginate(10);
        }

        $count_admins = User::where('user_type','!=','author')->where('status','!=',2)->count();
        $count_s_admins = User::where('user_type','super_admin')->where('status','!=',2)->count();
        $count_u_admins = User::where('user_type','unite_admin')->where('status','!=',2)->count();
        $count_trash = User::where('status',2)->count();
        return view('admin-panel.admins.admins',[
            'admins'=>$admins,
//            'count_unites'=> $count_unites,
            'count_trash' => $count_trash,
            'count_admins'=>$count_admins,
            'count_s_admins'=>$count_s_admins,
            'count_u_admins'=>$count_u_admins
        ]);
    }
    public function members(Request $request)
    {
        $admin_check = $this->admin_check($request->session()->get('admin_type'));

        $count_all_members = DB::table('user_accounts')
            ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
            ->where('user_accounts.status','!=','banned')
            ->where('user_accounts.check','!=','0');
        $count_pending_members = DB::table('user_accounts')
            ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
            ->where('user_accounts.status','=','not_check')
            ->where('user_accounts.check','!=','0');
        $count_active_members = DB::table('user_accounts')
            ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
            ->where('user_accounts.status','=','approved')
            ->where('user_accounts.check','!=','0');
        $count_deactivated_members = DB::table('user_accounts')
            ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
            ->where('user_accounts.status','=','deactivated')
            ->where('user_accounts.check','!=','0');
        $count_banned_members = DB::table('user_accounts')
            ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
            ->where('user_accounts.status','=','banned')
            ->where('user_accounts.check','!=','0');
        $members_data_table = DB::table('user_accounts')
            ->join('user_personal_infos','user_accounts.id','=','user_personal_infos.user_id')
            ->join('user_contact_infos','user_accounts.id','=','user_contact_infos.user_id')
            ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
            ->join('member_types','user_accounts.member_type','=','member_types.id')
            ->select('user_accounts.id','user_accounts.phone','user_accounts.status','user_personal_infos.profile_image',
            'user_personal_infos.name','user_beca_details.beca_reg_id','member_types.type_name','user_contact_infos.email')
            ->where('user_accounts.check','!=','0');
        if(!$admin_check){
            $members_data_table->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $count_all_members->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $count_active_members->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $count_deactivated_members->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $count_banned_members->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $count_pending_members->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
        }
        if($request->has('filter')){
            $members_data = $members_data_table->where('user_accounts.status','=',$request->filter)
                ->paginate(10)->appends('filter',$request->filter);
        }elseif($request->has('member_type')){
            $members_data = $members_data_table->where('user_accounts.member_type','=',$request->member_type)
                ->paginate(10)->appends('member_type',$request->member_type);
        }elseif($request->has('unite')){
            $members_data = $members_data_table->where('user_beca_details.current_unite','=',$request->unite)
                ->paginate(10)->appends('unite',$request->unite);
        }else{
            $members_data = $members_data_table->where('user_accounts.status','!=','banned')
                ->paginate(10);
        }

        $count_all_members = $count_all_members->count();
        $count_active_members = $count_active_members->count();
        $count_deactivated_members = $count_deactivated_members->count();
        $count_banned_members = $count_banned_members->count();
        $count_pending_members = $count_pending_members->count();
        $unites = unites::where('publish',1)->get();
        $members_type = MemberType::where('publish',1)->get();
        return view('admin-panel.members.members',[
            'members_data'=>$members_data,
            'count_all_members'=>$count_all_members,
            'count_active_members'=>$count_active_members,
            'count_deactivated_members'=>$count_deactivated_members,
            'count_banned_members'=>$count_banned_members,
            'count_pending_members'=>$count_pending_members,
            'members_type' => $members_type,
            'unites' => $unites,
        ]);
    }




    public function membersDetails($user_id,Request $request)
    {
        $admin_check = $this->admin_check($request->session()->get('admin_type'));


        $beca_details = UserBecaDetails::where('user_id','=',$user_id)->first();
        if(!$admin_check && ($beca_details->current_unite != $request->session()->get('admin_unite_id'))){
            return redirect('/admin_panel/login');
        }
        $account_info = UserAccount::find($user_id);
        $personal_info = UserPersonalInfo::where('user_id','=',$user_id)->first();
        $address_details = UserAddressInfo::where('user_id','=',$user_id)->first();
        $contact_details = UserContactInfo::where('user_id','=',$user_id)->first();
        $payment_info = UserPaymentDetails::where('user_id','=',$user_id)->get();
        $verification_docs = UserVerificationDoc::where('user_id','=',$user_id)->first();
        $edu_pro_details = UserEducationProfession::where('user_id','=',$user_id)->first();
        $cadet_details = UserCadetDetails::where('user_id','=',$user_id)->first();
        $current_unite_find = unites::find($beca_details->current_unite);
        $current_unite = $current_unite_find->unite_name;
        $member_type_find= MemberType::find($account_info->member_type);
        $member_type_name = $member_type_find->type_name;
        if(!$admin_check && ($beca_details->current_unite != $request->session()->get('admin_unite_id'))){
            return redirect('/admin_panel/login');
        }
        return view('admin-panel.members.membersDetails',['personal_info'=>$personal_info,
            'address_details'=>$address_details,
            'edu_pro_details'=>$edu_pro_details,
            'cadet_details' =>$cadet_details,
            'contact_details' =>$contact_details,
            'payment_info' =>$payment_info,
            'verification_docs'=>$verification_docs,
            'beca_details' =>$beca_details,
            'account_info' =>$account_info,
            'current_unite'=>$current_unite,
            'member_type' => $member_type_name,
        ]);
        return view('admin-panel.members.membersDetails',['members_data'=> $members_data]);
    }



    public function payments(Request $request)
    {
        $admin_check = $this->admin_check($request->session()->get('admin_type'));
        $paymen_data = DB::table('user_payment_details')
            ->join('user_beca_details','user_beca_details.user_id','=','user_payment_details.user_id')
            ->join('user_accounts','user_accounts.id','=','user_payment_details.user_id');
        $unite_admin = false;
        if(!$admin_check){
            $paymen_data->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
            $unite_admin = true;
        }

        $count_payment = $paymen_data->sum('user_payment_details.payment_amount');
        $donation_payment = $paymen_data->where('user_payment_details.payment_for','=','donation')
                                        ->sum('user_payment_details.payment_amount');
        $membership_payment = $count_payment - $donation_payment;
        $withdraw = 'not_approve';
        $balance = '';
        $withdraws = '';
        if($admin_check){
            $withdraw = Withdraw::all()->sum('amount');
            $balance = $count_payment - $withdraw;
        }
        $paymen_data_table = DB::table('user_payment_details')
            ->join('user_beca_details','user_beca_details.user_id','=','user_payment_details.user_id')
            ->join('user_personal_infos','user_personal_infos.user_id','=','user_payment_details.user_id');
        if(!$admin_check){
            $paymen_data_table->where('user_beca_details.current_unite','=',$request->session()->get('admin_unite_id'));
        }
        if($request->has('filter') && ($request->filter != 'withdraw')){
            $paymen_data_table->where('user_payment_details.payment_for','=',$request->filter);
            $payment_table_data = $paymen_data_table->orderBy('user_payment_details.id', 'DESC')->paginate(10)->appends('filter',$request->filter);
        }elseif($request->has('filter') && ($request->filter == 'withdraw')){
            $withdraws = DB::table('withdraws')
                ->join('users','users.id','=','withdraws.withdraw_by')
                ->select('users.name','withdraws.*')
                ->orderBy('withdraws.id', 'DESC')->paginate(10)->appends('filter',$request->filter);
            $payment_table_data = 'undefined';
        }else{
            $payment_table_data = $paymen_data_table->orderBy('user_payment_details.id', 'DESC')->paginate(10);
        }

        return view('admin-panel.payments.payment',[
            'unite_admin'=>$unite_admin,
            'withdraw' =>$withdraw,
            'withdraws' =>$withdraws,
            'balance' => $balance,
            'all_payment'=> $count_payment,
            'donation_payment'=>$donation_payment,
            'membership_payment'=>$membership_payment,
            'payment_table_data' =>$payment_table_data,
        ]);
    }


    public function addAdmin()
    {

        $unites = unites::where('publish',1)->get();
        return view('admin-panel.add.newadmin',['unites'=>$unites]);
    }
    public function addUnite(Request $request)
    {
        $unites = unites::where('publish','!=',2)->paginate(10);
        $total_unites = count($unites);
        $total_trash = unites::where('publish','=',2)->count();
        if($request->has('filter') && $request->filter = 'trash'){
            $unites = unites::where('publish','=',2)->paginate(10)->appends('filter',$request->filter);
        }
        return view('admin-panel.add.addunite',['total_unites'=>$total_unites,'total_trash'=>$total_trash,'unites'=>$unites]);
    }
    public function addmemberstype(Request $request)
    {
        $members_type = DB::table('member_types')
            ->join('users','users.id','=','member_types.edited_by')
            ->leftJoin('user_accounts','user_accounts.member_type','=','member_types.id')
            ->select(DB::raw('IFNULL(COUNT(user_accounts.member_type), 0) as reg_member'),
                'member_types.id','member_types.type_name',
                'member_types.payment_amount','member_types.details',
                'member_types.time_duration','member_types.publish',
                'users.name','member_types.created_at')
            ->groupBy('member_types.id','member_types.type_name',
                'member_types.payment_amount','member_types.details',
                'member_types.time_duration','member_types.publish',
                'users.name','member_types.created_at');
        $count_published = MemberType::where('publish',1)->count();
        $count_unpublished = MemberType::where('publish',0)->count();
        $count_trash = MemberType::where('publish',2)->count();
        if($request->has('filter') && $request->filter == 2){

        }else{
            $members_type->where('member_types.publish','!=',2);
        }
        if($request->has('filter')){
            $members_type = $members_type->where('member_types.publish','=',$request->filter)->get();
        }else{
            $members_type = $members_type->get();
        }
        return view('admin-panel.add.addmembers_type',[
            'members_type'=>$members_type,
            'count_published'=>$count_published,
            'count_unpublished'=>$count_unpublished,
            'count_trash'=>$count_trash,
            ]);
    }
    public function updatememberstype($target,Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }

        $members_type = MemberType::find($target);

        return view('admin-panel.update.updateMemberType',[
            'members_type'=>$members_type,
        ]);
    }
    public function updateUnite($target,Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }

        $unite = unites::find($target);

        return view('admin-panel.update.updateUnite',[
            'unite'=>$unite,
        ]);
    }
    public function updateAdmin($admin_id)
    {
        $admin_data = User::find($admin_id);
        $unites = unites::all();
        return view('admin-panel.update.updateAdmin',['admin'=>$admin_data,'unites'=>$unites]);
    }
    public function firstLoginShow(Request $request)
    {
        $admin_data = User::find($request->session()->get('admin_id'));
        if($admin_data->check == 1){
            return redirect('/admin_panel/');
        }

        if(!empty($admin_data->name) && !empty($admin_data->email) && !empty($admin_data->image)){
            if($admin_data->check != 1){
                $admin_data->check = 1;
                $admin_data->save();
                return redirect('/admin_panel/');
            }
        }

        return view('admin-panel.first_login.first_login',['admin_data'=>$admin_data]);
    }


}
