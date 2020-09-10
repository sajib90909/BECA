<?php

namespace App\Http\Middleware;

use App\UserAccount;
use Closure;

class membersLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('members_login')){
            $user_check = UserAccount::find($request->session()->get('members_id'));
            if(isset($user_check->check_payment) && $user_check->check_payment == 0){
                return redirect('/payment');
            }elseif (isset($user_check->check_doc) && $user_check->check_doc == 0){
                return redirect('/Verification_doc');
            }elseif(isset($user_check->check) && $user_check->check == 0){
                return redirect('/new_login');
            }elseif(isset($user_check->status) && $user_check->status == 'banned'){
                return redirect('/login')->with('error_message','You are suspended! Please Contact with authorities');
            }else{
                return $next($request);
            }
        }else{
            return redirect('/login');
        }

    }
}
