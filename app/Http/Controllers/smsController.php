<?php

namespace App\Http\Controllers;

use App\MemberType;
use App\sms;
use App\sms_count;
use App\unites;
use App\User;
use App\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use smsSend;

class smsController extends Controller
{
    private function smsDecCount(){
        $sms_balance = sms_count::latest()->first();
        if(!empty($sms_balance)){
            $sms_balance->balance = $sms_balance->balance - $sms_balance->cost;
            $sms_balance->sms = $sms_balance->sms - 1;
            $sms_balance->save();
        }
    }
    public function sendSms($content,$send_by,$send_to)
    {
        $send = false;
        $sms_data = new sms();
        if($send_by == 0){
            $sms_data->content = 'OTP / coupon';
        }else{
            $sms_data->content = $content;
        }
        $response = smsSend::send_sms($send_to,$content);

        $sms_data->send_by = $send_by;
        $sms_data->send_to = $send_to;
        $sms_data->send_from = 0;
        if($response == 1002){
            $response_msg = 'Sender Id/Masking Not Found';
        }elseif($response == 1003){
            $response_msg = 'API Not Found';
        }elseif($response == 1004){
            $response_msg = 'SPAM Detected';
        }elseif($response == 1005){
            $response_msg = 'Internal Error';
        }elseif($response == 1006){
            $response_msg = 'Internal Error';
        }elseif($response == 1007){
            $response_msg = 'Balance Insufficient';
        }elseif($response == 1008){
            $response_msg = 'Message is empty';
        }elseif($response == 1009){
            $response_msg = 'Message Type Not Set (text/unicode)';
        }elseif($response == 1010){
            $response_msg = 'Invalid User & Password';
        }elseif($response == 1011){
            $response_msg = 'Invalid User Id';
        }elseif($response == 1012){
            $response_msg = 'Invalid Number';
        }elseif($response == 1013){
            $response_msg = 'API limit error';
        }elseif($response == 1014){
            $response_msg = 'No matching template';
        }elseif($response == 1015){
            $response_msg = 'SMS Content Validation Fails';
        }else{
            $response_msg = $response;
            $sms_data->status = 1;
            $this->smsDecCount();
            $send = true;
        }
        $sms_data->response_msg = $response_msg;
        $sms_data->save();
        if($send){
            return true;
        }
        return false;
    }
    public function smsView(Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $sms_count = sms::where('status',1)->count();
        $failed_sms_count = sms::where('status',0)->count();
        $sms_data = DB::table('sms')
            ->leftJoin('users','users.id','=','sms.send_by')
            ->select('users.name','sms.*')
            ->orderBy('id','DESC')
            ->paginate(10);
        $sms_balance = sms_count::latest()->first();
        $unites = unites::where('publish','!=',2)->get();
        $members_type = MemberType::where('publish','!=',2)->get();
        return view('admin-panel.sms.sms',[
            'sms_count'=>$sms_count,
            'failed_sms_count'=>$failed_sms_count,
            'sms_data'=>$sms_data,
            'sms_balance'=>$sms_balance,
            'unites' =>$unites,
            'members_type'=>$members_type
        ]);
    }
    public function smsSendFunc(Request $request)
    {
        $this->validate($request,[
            'sms_content' => 'required|max:400',
        ]);
        $message_type = 'error_message';
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $sms_numbers = [];
        //array_push($z, 'she', 'it');
        if($request->active_member || $request->deactivated_member || $request->unite_wise || $request->member_type_wise){
            $member_data = DB::table('user_accounts')
                ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id');

            if($request->unite_wise){
                $this->validate($request,[
                    'unite' => 'required',
                ]);
                $member_data->where('user_beca_details.current_unite',$request->unite);
            }
            if($request->member_type_wise){
                $this->validate($request,[
                    'member_type' => 'required',
                ]);
                $member_data->where('user_accounts.member_type',$request->member_type);
            }
            if($request->active_member){
                $member_data->where('status','deactivated');
            }
            if($request->deactivated_member){
                $member_data->where('status','deactivated');
            }
            $member_data_number = $member_data->whereNotNull('user_accounts.phone')->select('user_accounts.phone')->get();
            foreach ($member_data_number as $number){
                array_push($sms_numbers,$number->phone);
            }
        }

        if($request->super_admin || $request->unite_admin){
            $admin_data = User::where('status','!=',2);

            if($request->super_admin){
                $admin_data = User::where('user_type','super_admin');
            }
            if($request->unite_admin){
                $admin_data = User::where('user_type','unite_admin');
            }
            $admin_data_number = $admin_data->select('phone')->get();
            foreach ($admin_data_number as $number){
                array_push($sms_numbers,$number->phone);
            }
        }

        if($request->custom){
            $this->validate($request,[
                'custom_number' => 'required',
            ]);
            $custom_number = explode(",", $request->custom_number);
            $custom_number = array_map('trim', $custom_number);
            foreach ($custom_number as $number){
                array_push($sms_numbers,$number);
            }
//            return $sms_numbers;
        }


        if(count($sms_numbers) > 0){
            $sms_balance = sms_count::latest()->first();
            if(!empty($sms_balance)){
                if($sms_balance->sms >= count($sms_numbers)){
                    $message_type = 'message';
                    $send = 0;
                    $not_send = 0;
                    foreach ($sms_numbers as $number){
                        if($this->sendSms($request->sms_content,$request->session()->get('admin_id'),$number)){
                            $send++;
                        }else{
                            $not_send++;
                        }
                    }
                    $message = 'Your sms send successfully Send: '.$send.', Not Send: '.$not_send;
                }else{
                    $message = 'Your Number of massage Exits your balance Balance SMS: '.$sms_balance->sms.' Requested Number: '.count($sms_numbers);
                }
                $sms_balance->balance = $sms_balance->balance - $sms_balance->cost;
                $sms_balance->sms = $sms_balance->sms--;
                $sms_balance->save();
            }else{
                $message = 'No balance data Found!';
            }
        }else{
            $message = 'No Number Found!';
        }
        return redirect('admin_panel/sms')->with($message_type,$message);

    }
    public function smsBalanceUpdate(Request $request){
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author')) || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $api = env('SMS_API_KEY');
        $url_data = Http::get('http://bulk.fmsms.biz/miscapi/'.$api.'/getBalance');
        $balance_slice = explode(' ', $url_data);
        $balance = array_pop($balance_slice);
        $cost = 0.22;
        $estimate_sms = floor($balance / $cost);

        $sms_balance = new sms_count();
        if(!empty($balance)){
            $sms_balance->balance = $balance;
            $sms_balance->sms = $estimate_sms;
            $sms_balance->cost = $cost;
            $sms_balance->save();
        }
        return redirect('admin_panel/sms')->with('message','Update Your SMS balance');

    }
}
