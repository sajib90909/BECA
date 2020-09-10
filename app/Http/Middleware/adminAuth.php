<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class adminAuth
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
        if($request->session()->has('admin_login')){
            $user_check = User::find($request->session()->get('admin_id'));
            if(isset($user_check->status) && $user_check->status != 1){
                return redirect('/admin_panel/login')->with('error_message','Your ID is Inactive or suspended');
            }elseif(isset($user_check->check) && $user_check->check != 1){
                return redirect('/admin_panel/first_login');
            }else{
                if($user_check->user_type == 'super_admin'){
                    $request->session()->put('admin_type', 'super');
                }elseif($user_check->user_type == 'author'){
                    $request->session()->put('admin_type', 'author');
                }elseif($user_check->user_type == 'unite_admin'){
                    $request->session()->put('admin_type', 'unite');
                    $request->session()->put('admin_unite_id', $user_check->unite_id);
                }else{
                    return redirect('/admin_panel/login');
                }

                return $next($request);
            }
        }else{
            return redirect('/admin_panel/login');
        }
    }
}
