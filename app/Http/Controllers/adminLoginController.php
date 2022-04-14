<?php

namespace App\Http\Controllers;

use App\PasswordReset;
use App\sms;
use App\sms_count;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use smsSend;

class adminLoginController extends Controller
{
    private function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
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
    public function loginPage(Request $request){
        $action = 'login';
        $request->session()->forget('admin_login');
        $request->session()->forget('admin_phone');
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_type');
        $request->session()->forget('admin_unite_id');
        return view('admin-panel.auth.login',['action'=>$action]);
    }
    public function logout_action(Request $request)
    {
        $request->session()->forget('admin_login');
        $request->session()->forget('admin_phone');
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_type');
        $request->session()->forget('admin_unite_id');
        return redirect('/admin_panel/login');

    }
    public function loginAction(Request $request){
        $user_data = User::where('user_name',$request->user_name)->first();

        if(!empty($user_data) && password_verify($request->password,$user_data->password)){
            $request->session()->put('admin_login', true);
            $request->session()->put('admin_phone', $user_data->phone);
            $request->session()->put('admin_id', $user_data->id);
            if($user_data->user_type = 'super_admin'){
                $request->session()->put('admin_type','super');
            }elseif($user_data->user_type = 'author'){
                $request->session()->put('admin_type','author');
            }else{
                $request->session()->put('admin_type','unite');
            }
            $request->session()->put('admin_unite_id',$user_data->unite_id);
            return redirect('/admin_panel');
        }else{
            return redirect('/admin_panel/login')->with('error_message','Password or email address is wrong!');
        }
    }
    public function forgetPassPage(){
        $action = 'forgetpass';
        return view('admin-panel.auth.login',compact(['action']));

    }
    public function forgetPassVerify(Request $request){
        $action = 'verify';

        $this->validate($request,[
            'phone' => 'required',
        ]);
        $members_data = User::where('phone',$request->phone);
        $phone_exits = $members_data->count();
        if($phone_exits == 0){
            return redirect('/admin_panel/login')->with('error_message','Phone Number Not Found!');
        }
        $data = $members_data->first();
        $reset_pass_data = PasswordReset::where('user_id',$data->id);
        $rest_data_exits = $members_data->count();
        if($rest_data_exits > 0){
            $reset_pass_data->delete();
        }
        $reset_pass = new PasswordReset();
        $token = $this->generateRandomString(5);
//        $token = '123AB';
        $reset_pass->user_id = $data->id;
        $reset_pass->phone = $data->phone;
        $reset_pass->token = Hash::make($token);
        $msg = 'বাংলাদেশ এক্স-ক্যাডেটস এসোসিয়েশন (বেকা) আপনাকে ভেরিফিকেসন কোড পাঠিয়েছে-  '.$token;
//        smsSend::send_sms($data->phone,$msg);
        $this->sendSms($msg,0,$data->phone);
        $phone = $data->phone;
        $reset_pass->save();
        return view('admin-panel.auth.login',['action'=>$action,'phone'=>$phone]);
    }
    public function resetPass(Request $request){
        $action = 'passreset';
        $this->validate($request,[
            'phone' => 'required',
            'token' => 'required',
        ]);
        $check_token = PasswordReset::where('phone',$request->phone);
        $check_token_count = $check_token->count();
        if($check_token_count == 0){
            return redirect('/admin_panel/login')->with('error_message','Invalid verification Code!');
        }
        $check_token_data = $check_token->first();
        if(!empty($check_token_data) && password_verify($request->token,$check_token_data->token)){
            $today_date = Carbon::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
            $createDate = Carbon::createFromFormat('Y-m-d H:i:s',$check_token_data->created_at);
            $diff_time = $createDate->diffInDays($today_date);
            if($diff_time >= 1){
                $check_token->delete();
                return redirect('/admin_panel/login')->with('error_message','Verification Code time Up! try again!');
            }
            $phone = $request->phone;
            $token = $request->token;
            return view('admin-panel.auth.login',compact(['action','phone','token']));
        }
        return redirect('/admin_panel/login')->with('error_message','Invalid verification Code!');
    }
    public function forgetPassAction(Request $request){
        $this->validate($request,[
            'phone' => 'required',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $check_token = PasswordReset::where('phone',$request->phone);
        $check_token_count = $check_token->count();
        if($check_token_count == 0){
            return redirect('/admin_panel/login')->with('error_message','Invalid verification Code!');
        }
        $check_token_data = $check_token->first();
        if(!empty($check_token_data) && password_verify($request->token,$check_token_data->token)){
            $today_date = Carbon::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
            $createDate = Carbon::createFromFormat('Y-m-d H:i:s',$check_token_data->created_at);
            $diff_time = $createDate->diffInDays($today_date);
            if($diff_time >= 1){
                $check_token->delete();
                return redirect('/admin_panel/login')->with('error_message','Verification Code time Up! try again!');
            }else{
                $member_data = User::where('phone',$check_token_data->phone)->where('id',$check_token_data->user_id)->first();
                if(!empty($check_token_data)){
                    $member_data->password = Hash::make($request->password);
                    $member_data->save();
                    return redirect('/admin_panel/login')->with('message','Pessword Update Successfully!');
                }
            }

        }
        return redirect('/admin_panel/login')->with('error_message','Invalid verification Code!');
    }


}
