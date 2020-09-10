<?php

namespace App\Http\Controllers;

use App\activeLogAdmins;
use App\CuponCode;
use App\MemberType;
use App\sms;
use App\sms_count;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use smsSend;

class couponController extends Controller
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
    public function activeLog($action_admin,$action_user_id,$action_details,$type){
        $active_log = new activeLogAdmins();
        $active_log->action_admin_id = $action_admin;
        $active_log->action_user_id = $action_user_id;
        $active_log->user_type = $type;
        $active_log->action_details = $action_details;
        $active_log->save();
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
    public function couponPage(Request $request, $action){

        if($request->session()->get('admin_type') == 'unite'){
            $count_used = CuponCode::whereNotNull('user_id')
                ->where('edited_by',$request->session()->get('admin_id'))
                ->count();
            $count_unused = CuponCode::whereNull('user_id')
                ->where('edited_by',$request->session()->get('admin_id'))
                ->count();
            $paid_coupon = CuponCode::where('receive_cash',1)
                ->where('edited_by',$request->session()->get('admin_id'))
                ->get();
            $unpaid_coupon = CuponCode::where('receive_cash',0)
                ->where('edited_by',$request->session()->get('admin_id'))
                ->get();
        }else{
            $count_used = CuponCode::whereNotNull('user_id')->count();
            $count_unused = CuponCode::whereNull('user_id')->count();
            $paid_coupon = CuponCode::where('receive_cash',1)->get();
            $unpaid_coupon = CuponCode::where('receive_cash',0)->get();
        }

        $paid_cash = 0;
        $unpaid_cash = 0;
        foreach ($paid_coupon as $coupon) {
            $members_type = MemberType::where('id',$coupon->member_type)->first();
            $members_type_cash = $members_type->payment_amount;
            $paid_cash += $members_type_cash;
        }foreach ($unpaid_coupon as $coupon) {
            $members_type = MemberType::where('id',$coupon->member_type)->first();
            $members_type_cash = $members_type->payment_amount;
            $unpaid_cash += $members_type_cash;
        }
        $count_paid = count($paid_coupon);
        $count_unpaid = count($unpaid_coupon);

        $query = DB::table('cupon_codes');

        $query->whereNotNull('user_id');


        $results = $query->get();

        $coupons = DB::table('cupon_codes');
        $coupons->join('member_types','member_types.id','=','cupon_codes.member_type');
        $coupons->join('users','users.id','=','cupon_codes.edited_by');
        $coupons->leftJoin('user_personal_infos','user_personal_infos.user_id','=','cupon_codes.user_id');
        $coupons->select('cupon_codes.*','member_types.type_name as member_type_name',
                    'users.name as adder_admin_name','users.id as adder_admin_id','member_types.id as member_type_id',
                    'user_personal_infos.user_id as use_user_id','user_personal_infos.name as use_user_name'
                );

        if($action == 'used'){
            $coupons->whereNotNull('cupon_codes.user_id');

        }elseif($action == 'unused'){
            $coupons->whereNull('cupon_codes.user_id');
        }elseif($action == 'paid'){
            $coupons->where('cupon_codes.receive_cash','=',1);

        }elseif($action == 'unpaid'){
            $coupons->where('cupon_codes.receive_cash','=',0);
        }else{
            return redirect('/admin_panel/login');
        }
        if($request->session()->get('admin_type') == 'unite'){
            $coupons->where('cupon_codes.edited_by','=',$request->session()->get('admin_id'));
        }
        $coupons = $coupons->get();
        return view('admin-panel.coupon.coupon',['coupons'=>$coupons,
            'count_used'=>$count_used,
            'count_unused'=>$count_unused,
            'count_paid'=>$count_paid,
            'count_unpaid'=>$count_unpaid,
            'paid_cash' => $paid_cash,
            'unpaid_cash' => $unpaid_cash,
            'action' => $action
        ]);
    }
    public function couponNewCreate(){
        $couponsCode = $this->generateRandomString(8);
        $members_type = MemberType::where('publish','1')->get();
        return view('admin-panel.coupon.addCoupon',['couponsCode'=>$couponsCode,'members_type'=>$members_type]);
    }
    public function couponNewCreateAction(Request $request){
        $this->validate($request,[
            'code' => 'required|unique:cupon_codes',
            'member_type' => 'required',
        ]);
        $coupons = new CuponCode();
        $coupons->code = $request->code;
        $coupons->member_type = $request->member_type;
        $coupons->edited_by = $request->session()->get('admin_id');
        $coupons->user_phone = $request->user_phone;

        if($request->session()->get('admin_type') == 'super' || $request->session()->get('admin_type') == 'author'){
            if($request->receive_cash){
                $coupons->receive_cash = 1;
            }
        }else{
            $coupons->receive_cash = 1;
        }



        $coupons->save();
        if($request->send_code){
            $msg = 'BECA (Bangladesh Ex-Cadet Association) send you a registration coupon code '.$request->code;
//            smsSend::send_sms($request->user_phone,$msg);
            $this->sendSms($msg,1,$request->user_phone);
        }

//        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'cupon';
        $active_log_action_details = 'created new coupon';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/coupons/used')->with('message','Coupon make successfully');
    }
    public function couponDelete($id,Request $request){

        $cupon_data_table = CuponCode::where('status',0)->where('id',$id);
        if($request->session()->get('admin_type') == 'super' || $request->session()->get('admin_type') == 'author'){
            $cupon_data = $cupon_data_table->delete();
        }else{
            $cupon_data_table->where('edited_by',$request->session()->get('admin_id'));
            $cupon_data = $cupon_data_table->delete();
        }

//        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = 0;
        $active_log_user_type = 'cupon';
        $active_log_action_details = 'Delete a coupon';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect('/admin_panel/coupons/used')->with('message','Coupon delete successfully');
    }
}
