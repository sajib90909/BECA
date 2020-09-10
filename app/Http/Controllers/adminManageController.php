<?php

namespace App\Http\Controllers;

use App\activeLogAdmins;
use App\MemberType;
use App\unites;
use App\User;
use App\UserPersonalInfo;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class adminManageController extends Controller
{
    public function activeLog($action_admin,$action_user_id,$action_details,$type){
        $active_log = new activeLogAdmins();
        $active_log->action_admin_id = $action_admin;
        $active_log->action_user_id = $action_user_id;
        $active_log->user_type = $type;
        $active_log->action_details = $action_details;
        $active_log->save();
    }
    public function addUnite(Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $this->validate($request,[
            'unite_name' => 'required|unique:unites',
//            'description' => 'required'
        ]);
        $unites = new unites();
        $unites->unite_name = $request->unite_name;
        $unites->description = $request->description;
        $unites->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'unite';
        $active_log_action_details = 'created new Unite name '.$request->unite_name;
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/add/unite')->with('message','New Unite Added Successfully');
    }
    public function updateUnite(Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $this->validate($request,[
            'unite_id' => 'required',
            'unite_name' => 'required|unique:unites,unite_name,'.$request->unite_id,

//            'description' => 'required'
        ]);
        $unites = unites::find($request->unite_id);
        $unites->unite_name = $request->unite_name;
        $unites->description = $request->description;
        $unites->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'unite';
        $active_log_action_details = 'Update a Unite name '.$request->unite_name;
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/add/unite')->with('message','Unite Update Successfully');
    }
    public function addMembertype(Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $this->validate($request,[
            'type_name' => 'required|unique:member_types',
            'payment_amount' => 'required',
            'time_duration' => 'required',
//            'description' => 'required'
        ]);
        $members_type = new MemberType();
        $members_type->type_name = $request->type_name;
        $members_type->payment_amount = $request->payment_amount;
        $members_type->time_duration = $request->time_duration;
        $members_type->details = $request->details;
        $members_type->edited_by = $request->session()->get('admin_id');
        $members_type->save();


        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'member_type';
        $active_log_action_details = 'created new member type name '.$request->type_name;
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/add/members_type')->with('message','New Members Type Added Successfully');
    }
    public function updateMembertype(Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $this->validate($request,[
            'type_name' => 'required|unique:member_types,type_name,'.$request->member_type_id,
            'payment_amount' => 'required',
            'time_duration' => 'required',
            'member_type_id'=>'required',
//            'description' => 'required'
        ]);
        $members_type = MemberType::find($request->member_type_id);
        $members_type->type_name = $request->type_name;
        $members_type->payment_amount = $request->payment_amount;
        $members_type->time_duration = $request->time_duration;
        $members_type->details = $request->details;
        $members_type->edited_by = $request->session()->get('admin_id');
        $members_type->save();


        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'member_type';
        $active_log_action_details = 'update a member type name '.$request->type_name;
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/add/members_type')->with('message','Members Type update Successfully');
    }
    public function updateLightmemberstype($target,$action,Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }

        $members_type = MemberType::find($target);
        if($action == 'published'){
            $members_type->publish = 1;
            $active_log_action_details = 'Published a member type name '.$members_type->type_name;
        }elseif($action == 'unpublished'){
            $members_type->publish = 0;
            $active_log_action_details = 'Unpublished a member type name '.$members_type->type_name;
        }elseif($action == 'trash'){
            $members_type->publish = 2;
            $active_log_action_details = 'Remove a member type name '.$members_type->type_name;
        }else{
            return redirect('/admin_panel/login');
        }

        $members_type->edited_by = $request->session()->get('admin_id');
        $members_type->save();


        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'member_type';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/add/members_type')->with('message','Members Type update Successfully');
    }
    public function updateLightunite($target,$action,Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }

        $unites_type = unites::find($target);
        if($action == 'published'){
            $unites_type->publish = 1;
            $active_log_action_details = 'Published a Unite name '.$unites_type->unite_name;
        }
//        elseif($action == 'unpublished'){
//            $members_type->publish = 0;
//            $active_log_action_details = 'Unpublished a member type name '.$members_type->type_name;
//        }
        elseif($action == 'trash'){
            $unites_type->publish = 2;
            $active_log_action_details = 'Remove a unite. name '.$unites_type->unite_name;
        }else{
            return redirect('/admin_panel/login');
        }

        $unites_type->edited_by = $request->session()->get('admin_id');
        $unites_type->save();


        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'unite';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/add/unite')->with('message','Members Type update Successfully');
    }

    public function addAdmin(Request $request)
    {
        $this->validate($request,[
            'user_type' => 'required',
            'unite_id' => 'required|numeric',
            'user_name' => 'required|unique:users|alpha_num|max:25|min:5',
            'phone' => 'required|unique:users',
            'password' => 'required|max:25|min:6',
        ]);
        if(($request->user_type != 'super_admin' && $request->user_type != 'unite_admin')
            || (($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))
            || (($request->user_type == 'super_admin') && ($request->session()->get('admin_type') != 'author'))){
            return redirect('/admin_panel/login');
        }
        $admin = new User();
        $admin->user_type = $request->user_type;
        $admin->unite_id = $request->unite_id;
        $admin->user_name = $request->user_name;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->beca_reg_id = $request->beca_reg_id;
        $admin->created_by = $request->session()->get('admin_id');;
        $admin->password = Hash::make($request->password);
        $admin->save();
//        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $admin->id;
        $active_log_user_type = 'admin';
        $active_log_action_details = 'created new admin';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/add/admin')->with('message','New Admin Added Successfully');
    }
    public function updateAdmin(Request $request){
        $this->validate($request,[
            'user_type' => 'required',
            'unite_id' => 'required|numeric',
            'user_name' => 'required|unique:users,user_name,'.$request->admin_id.'|alpha_num|max:25|min:5',
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->admin_id.'|email',
            'phone' => 'required'|'unique:users,phone,'.$request->admin_id,
        ]);
        if(($request->user_type != 'super_admin' && $request->user_type != 'unite_admin')
            || (($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))
            || (($request->user_type == 'super_admin') && ($request->session()->get('admin_type') != 'author'))){
            return redirect('/admin_panel/login');
        }
        $admin = User::find($request->admin_id);
        $admin->user_type = $request->user_type;
        $admin->unite_id = $request->unite_id;
        $admin->user_name = $request->user_name;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->beca_reg_id = $request->beca_reg_id;
        $admin->edited_by = $request->session()->get('admin_id');
        if(!empty($request->password)){
            $this->validate($request,[
                'password' => 'required|max:25|min:6'
            ]);
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $admin->id;
        $active_log_user_type = 'admin';
        $active_log_action_details = 'updated an admin';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/admins')->with('message','Update Admin Successfully');
    }
    public function adminActive($admin_id,Request $request){
        $admin = User::find($admin_id);
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))
            || (($admin->user_type == 'super_admin') && ($request->session()->get('admin_type') != 'author'))){
            return redirect('/admin_panel/login');
        }
        $admin->status = 1;
        $admin->edited_by = $request->session()->get('admin_id');
        $admin->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $admin->id;
        $active_log_user_type = 'admin';
        $active_log_action_details = 'Active an admin';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/admins')->with('message','Active admin success');
    }
    public function adminMute($admin_id,Request $request){
        $admin = User::find($admin_id);
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))
            || (($admin->user_type == 'super_admin') && ($request->session()->get('admin_type') != 'author'))){
            return redirect('/admin_panel/login');
        }
        $admin->edited_by = $request->session()->get('admin_id');
        $admin->status = 0;
        $admin->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $admin->id;
        $active_log_user_type = 'admin';
        $active_log_action_details = 'Deactivated an admin';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/admins')->with('message','Mute admin success');
    }
    public function admintrash($admin_id,Request $request){
        $admin = User::find($admin_id);
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))
            || (($admin->user_type == 'super_admin') && ($request->session()->get('admin_type') != 'author'))){
            return redirect('/admin_panel/login');
        }
        $admin->edited_by = $request->session()->get('admin_id');
        $admin->status = 2;
        $admin->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $admin->id;
        $active_log_user_type = 'admin';
        $active_log_action_details = 'Remove an admin';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/admins')->with('message','Remove admin success');
    }
    public function firstloginAction(Request $request){
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);
        $profile_image_name = $request->session()->get('admin_id').'_'.rand(1, 10000).'_profile_image.'.$request->file('image')->extension();
        $upload_folder = 'admin_profile_images/';
        $file_url = $upload_folder.$profile_image_name;
        $admin_info = User::find($request->session()->get('admin_id'));
        if (!empty($admin_info->profile_image)){
            unlink('admin-panel/'.$admin_info->image);
        }
        $request->image->move('admin-panel/'.$upload_folder,$profile_image_name);
        $admin_info->image = $file_url;
        $admin_info->check = 1;
        $admin_info->edited_by = $request->session()->get('admin_id');
        $admin_info->save();

        return redirect('/admin_panel')->with('message','Welcome to Dashboard');
    }
    public function withdrawAddd(Request $request){

        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $this->validate($request,[
            'withdraw_title' => 'required',
            'amount' => 'required',
            'purpose' => 'required'
        ]);

        $withdraw = new Withdraw();
        $withdraw->withdraw_title = $request->withdraw_title;
        $withdraw->amount = $request->amount;
        $withdraw->purpose = $request->purpose;
        $withdraw->withdraw_by = $request->session()->get('admin_id');
        $withdraw->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'withdraw';
        $active_log_action_details = 'Making a withdraw. amount-'.$request->amount;
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/payments')->with('message','Withdraw success');
    }
    public function withdrawDelete($target, Request $request){

        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }

        $withdraw = Withdraw::find($target);
        $amount = $withdraw->amount;
        $withdraw->delete();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'withdraw';
        $active_log_action_details = 'delete a withdraw. amount-'.$amount;
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/payments?filter=withdraw')->with('message','Withdraw cancel and deleted');
    }

    public function accountUpdate(Request $request){
        $account_data = User::find($request->session()->get('admin_id'));
        $unite_name = unites::find($account_data->unite_id)->select('unite_name')->first();
        return view('admin-panel.admins.accountSettings',['account_data'=>$account_data,'unite_name'=>$unite_name]);
    }
    public function accountUpdateAction(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $admin_info = User::find($request->session()->get('admin_id'));
        $admin_info->name = $request->name;
        $admin_info->email = $request->email;
        if($request->image){
            $this->validate($request,[
                'image' => 'image|mimes:jpeg,png,jpg|max:1024',
            ]);
            $profile_image_name = $request->session()->get('admin_id').'_'.rand(1, 10000).'_profile_image.'.$request->file('image')->extension();
            $upload_folder = 'admin_profile_images/';
            $file_url = $upload_folder.$profile_image_name;
            if (!empty($admin_info->profile_image)){
                unlink('admin-panel/'.$admin_info->image);
            }
            $request->image->move('admin-panel/'.$upload_folder,$profile_image_name);
            $admin_info->image = $file_url;
        }
        if($request->password){
            $this->validate($request,[
                'password' => 'max:25|min:6',
            ]);
            $admin_info->password = Hash::make($request->password);
        }
        $admin_info->save();

//        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'admin';
        $active_log_action_details = 'Update Account';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----

        return redirect('admin_panel/update/account')->with('message','Account Update Successfully');
    }
}
