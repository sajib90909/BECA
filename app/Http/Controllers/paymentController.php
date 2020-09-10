<?php

namespace App\Http\Controllers;

use App\CuponCode;
use App\MemberType;
use App\UserAccount;
use App\UserPaymentDetails;
use Illuminate\Http\Request;

class paymentController extends Controller
{

    public function payment(Request $request){
        if(!$request->session()->has('members_login')){
            return redirect('/login');
        }
        return redirect('');
    }
    public function paymentCoupon(Request $request){
        if(!$request->session()->has('members_login')){
            return redirect('/login');
        }
        $this->validate($request,[
            'code' => 'required',
        ]);
        $coupon_check = CuponCode::where('code',$request->code)
            ->where('status',0)
            ->where('publish',1)
            ->first();
        if($coupon_check){
            if($coupon_check->receive_cash == 1){
                $payment_amount_on = MemberType::find($coupon_check->member_type);
                $payment_amount = $payment_amount_on->payment_amount;
            }else{
                $payment_amount = 0;
            }

            $payment_account = new UserPaymentDetails();
            $payment_account->user_id = $request->session()->get('members_id');
            $payment_account->payment_date = date('Y-m-d H:i:s');
            $payment_account->payment_amount = $payment_amount;
            $payment_account->method = 'coupon';
            $payment_account->approve = 1;
            $payment_account->payment_for = 'membership';
            $payment_account->save();

            $member_acount = UserAccount::find($request->session()->get('members_id'));
            $member_acount->member_type = $coupon_check->member_type;
            $member_acount->check_payment = 1;
            $member_acount->save();

            $coupon_check->user_id = $request->session()->get('members_id');
            $coupon_check->status = 1;
            $coupon_check->use_date = date('Y-m-d H:i:s');;
            $coupon_check->save();

        }else{
            return redirect('/payment')->with('payment_message_error','Coupon code invalid!');
        }
        return redirect('/user_panel/user_details')->with('payment_message','payment successfully done!');
    }
}
