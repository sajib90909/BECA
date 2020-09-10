<?php

namespace App\Http\Controllers;

use App\doc_verification_need;
use App\MemberType;
use App\PassResetMember;
use App\sms;
use App\sms_count;
use App\unites;
use App\UserAccount;
use App\UserAddressInfo;
use App\UserBecaDetails;
use App\UserCadetDetails;
use App\UserContactInfo;
use App\UserEducationProfession;
use App\UserPersonalInfo;
use App\UserVerificationDoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use MongoDB\Driver\Session;
use smsSend;
use Illuminate\Support\Facades\Crypt;

class membersAuthAction extends Controller
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
    private function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function registration_action(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required|unique:user_accounts',
            'password' => 'required|confirmed|max:25|min:6',
            'current_unite' => 'required|numeric',

        ]);
        $otp_code = rand(10000,99999);
//        $otp_code = 12345;
        $otp_code_encrypt = Crypt::encrypt($otp_code);
        $password = Crypt::encrypt($request->password);
        $msg = 'BECA (Bangladesh Ex-Cadet Association) send you a verification code '.$otp_code;
//        smsSend::send_sms($request->phone,$msg);
        $this->sendSms($msg,0,$request->phone);
        return redirect()->route('/user_panel/members/phone-verify/',['name'=>$request->name,'phone'=>$request->phone,'otp'=>$otp_code_encrypt,'password'=>$password,'current_unite'=>$request->current_unite]);
    }
    public function phone_verify($name,$phone,$otp,$password,$current_unite)
    {
        return view('members.auth.phoneVerify',['otp'=>$otp,
            'name'=>$name,
            'phone'=>$phone,
            'password'=>$password,
            'current_unite' => $current_unite,
        ]);
    }
    public function phone_verify_action(Request $request)
    {
        $otp = Crypt::decrypt($request->otp);
        $request->password = Crypt::decrypt($request->password);
        $this->validate($request,[
            'code' => 'required|in:'.$otp,
            'otp' => 'required',
            'name' => 'required',
            'phone' => 'required|unique:user_accounts',
            'password' => 'required|confirmed|min:6',
            'current_unite' => 'required|numeric',
        ]);
        $user_account = new UserAccount();
        $user_account->phone = $request->phone;
        $user_account->password = Hash::make($request->password);
        $user_account->save();
        $user_id = $user_account->id;
        $user_personal_info = new UserPersonalInfo();
        $user_personal_info->user_id = $user_id;
        $user_personal_info->name = $request->name;
        $user_personal_info->save();

        $user_address_info = new UserAddressInfo();
        $user_address_info->user_id = $user_id;
        $user_address_info->save();

        $user_edu_pro = new UserEducationProfession();
        $user_edu_pro->user_id = $user_id;
        $user_edu_pro->save();

        $user_cadet_details = new UserCadetDetails();
        $user_cadet_details->user_id = $user_id;
        $user_cadet_details->save();

        $user_beca_details = new UserBecaDetails();
        $user_beca_details->current_unite = $request->current_unite;
        $user_beca_details->user_id = $user_id;
        $user_beca_details->save();

        $user_contact_info = new UserContactInfo();
        $user_contact_info->user_id = $user_id;
        $user_contact_info->save();

        $verfication_doc = new UserVerificationDoc();
        $verfication_doc->user_id = $user_id;
        $verfication_doc->save();

        $request->session()->put('members_login', true);
        $request->session()->put('phone', $request->phone);
        $request->session()->put('members_id', $user_id);

//        return redirect('/login')->with('message','Registration Successfully done.you can login now');
        return redirect('/user_panel/user_details');
    }
    public function login_action(Request $request)
    {
        $user_data = UserAccount::where('phone',$request->phone)->first();

        if(!empty($user_data) && password_verify($request->password,$user_data->password)){
            $request->session()->put('members_login', true);
            $request->session()->put('phone', $user_data->phone);
            $request->session()->put('members_id', $user_data->id);
            return redirect('/user_panel/user_details');
        }else{
            return redirect('/login')->with('error_message','Password or email address is wrong!');
        }

    }
    public function logout_action(Request $request)
    {
        $request->session()->forget('members_login');
        $request->session()->forget('members_email');
        $request->session()->forget('members_id');
        return redirect('/login');

    }
    public function new_login(Request $request)
    {
        if(!$request->session()->has('members_login')){
           return redirect('/login');
        }
        $personal_info = true;
        $address_details = true;
        $edu_pro_details = true;
        $cadet_details = true;
        $contact_details = true;
        $set_action = 'personal_info';
        $check_personal_info = UserPersonalInfo::where('user_id','=',$request->session()->get('members_id'))
                                                    ->where('check','=',1)->count();
        if($check_personal_info > 0){
            $set_action = 'address_details';
        }else{
            $personal_info = false;
        }
        $check_address_details = UserAddressInfo::where('user_id','=',$request->session()->get('members_id'))
                ->where('check','=',1)->count();
        if($check_address_details > 0){
            $set_action = 'edu_pro_details';
        }else{
            $address_details = false;
        }
        $check_edu_pro_details = UserEducationProfession::where('user_id','=',$request->session()->get('members_id'))
                ->where('check','=',1)->count();
        if($check_edu_pro_details > 0){
            $set_action = 'cadet_details';
        }else{
            $edu_pro_details = false;
        }
        $check_cadet_details = UserCadetDetails::where('user_id','=',$request->session()->get('members_id'))
                ->where('check','=',1)->count();
        if($check_cadet_details > 0){
            $set_action = 'contact_details';
        }else{
            $cadet_details = false;
        }
        $check_Contact_details = UserContactInfo::where('user_id','=',$request->session()->get('members_id'))
                ->where('check','=',1)->count();
        if($check_Contact_details > 0){
            if($personal_info && $address_details && $edu_pro_details && $cadet_details && $contact_details){
                $userAccount = UserAccount::find($request->session()->get('members_id'));
                $userAccount->check = 1;
                $userAccount->save();
            }
            return redirect('/user_panel/user_details');
        }else{
            $contact_details = false;
        }
        $unites = unites::all();
        return view('user-panel.first_login.first_login',['personal_info'=>$personal_info,
            'address_details'=>$address_details,
            'edu_pro_details'=>$edu_pro_details,
            'cadet_details'=>$cadet_details,
            'contact_details'=>$contact_details,
            'set_action' => $set_action,
            'unites' => $unites
            ]);


    }
    public function payment(Request $request)
    {
        if(!$request->session()->has('members_login')){
            return redirect('/login');
        }
        $account_info = UserAccount::find($request->session()->get('members_id'));

        if($account_info->check_payment == 1){
            return redirect('/user_panel/user_details');
        }
        $members_type = MemberType::where('publish',1)->get();
        return view('user-panel.first_login.payment',['members_type'=>$members_type]);
    }

    public function verification_doc(Request $request)
    {
        if(!$request->session()->has('members_login')){
            return redirect('/login');
        }
        $account_info = UserAccount::find($request->session()->get('members_id'));

        if($account_info->check_doc == 1){
            return redirect('/user_panel/user_details');
        }
        $doc_need = doc_verification_need::where('user_id',$request->session()->get('members_id'))->first();
        return view('user-panel.first_login.document',['doc_need'=>$doc_need]);
    }
    public function resetPassPhoneVerify(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
        ]);
        $members_data = UserAccount::where('phone',$request->phone);
        $phone_exits = $members_data->count();
        if($phone_exits == 0){
            return redirect('/login')->with('error_message','Phone Number Not Found!');
        }
        $data = $members_data->first();
        $reset_pass_data = PassResetMember::where('user_id',$data->id);
        $rest_data_exits = $members_data->count();
        if($rest_data_exits > 0){
            $reset_pass_data->delete();
        }
        $reset_pass = new PassResetMember();
        $token = $this->generateRandomString(5);
//        $token = '123AB';
        $reset_pass->user_id = $data->id;
        $reset_pass->phone = $data->phone;
        $reset_pass->token = Hash::make($token);
        $msg = 'BECA (Bangladesh Ex-Cadet Association) send you a Password Reset verification code '.$token;
//        smsSend::send_sms($data->phone,$msg);
        $this->sendSms($msg,0,$data->phone);
        $action = 'phone_verify';
        $phone = $data->phone;
        $reset_pass->save();
        return view('members.auth.login',compact(['action','phone']));
    }
    public function resetPassView(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'token' => 'required',
        ]);
        $check_token = PassResetMember::where('phone',$request->phone);
        $check_token_count = $check_token->count();
        if($check_token_count == 0){
            return redirect('/login')->with('error_message','Invalid verification Code!');
        }
        $check_token_data = $check_token->first();
        if(!empty($check_token_data) && password_verify($request->token,$check_token_data->token)){
            $today_date = Carbon::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
            $createDate = Carbon::createFromFormat('Y-m-d H:i:s',$check_token_data->created_at);
            $diff_time = $createDate->diffInDays($today_date);
            if($diff_time >= 1){
                $check_token->delete();
                return redirect('/login')->with('error_message','Verification Code time Up! try again!');
            }
            $action = 'reset_pass';
            $phone = $request->phone;
            $token = $request->token;
            return view('members.auth.login',compact(['action','phone','token']));
        }
        return redirect('/login')->with('error_message','Invalid verification Code!');

    }
    public function resetPassAction(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $check_token = PassResetMember::where('phone',$request->phone);
        $check_token_count = $check_token->count();
        if($check_token_count == 0){
            return redirect('/login')->with('error_message','Invalid verification Code!');
        }
        $check_token_data = $check_token->first();
        if(!empty($check_token_data) && password_verify($request->token,$check_token_data->token)){
            $today_date = Carbon::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
            $createDate = Carbon::createFromFormat('Y-m-d H:i:s',$check_token_data->created_at);
            $diff_time = $createDate->diffInDays($today_date);
            if($diff_time >= 1){
                $check_token->delete();
                return redirect('/login')->with('error_message','Verification Code time Up! try again!');
            }else{
                $member_data = UserAccount::where('phone',$check_token_data->phone)->where('id',$check_token_data->user_id)->first();
                if(!empty($check_token_data)){
                    $member_data->password = Hash::make($request->password);
                    $member_data->save();
                    return redirect('/login')->with('message','Pessword Update Successfully!');
                }
            }

        }
        return redirect('/login')->with('error_message','Invalid verification Code!');


    }

}

