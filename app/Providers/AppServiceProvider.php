<?php

namespace App\Providers;

use App\ContentTable;
use App\User;
use App\UserPersonalInfo;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('admin-panel.includes.sidebar', function($view)
        {
            $view->with('admin_type',session('admin_type'));
        });
        view()->composer('members.master', function($view)
        {
            $view->with('logo',ContentTable::where('content_name','logo')->first());
        });
        view()->composer('members.master', function($view)
        {
            $view->with('header_content',ContentTable::where('content_name','header')->first());
        });
        view()->composer('user-panel.includes.topbar', function($view)
        {
            $view->with('member_info',UserPersonalInfo::where('user_id',session('members_id'))->first());
        });
        view()->composer('admin-panel.includes.topbar', function($view)
        {
            $view->with('account_data_top',User::where('id',session('admin_id'))->select('name','image')->first());
        });
        view()->composer('user-panel.master', function($view)
        {
            $view->with('head_notice_user',ContentTable::where('content_name','head_notice')->first());
        });
        view()->composer('admin-panel.includes.topbar', function($view)
        {
            $view->with('approve_request',DB::table('user_accounts')
                ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
                ->join('user_personal_infos','user_accounts.id','=','user_personal_infos.user_id')
                ->where('user_accounts.status','=','not_check')
                ->where('user_accounts.check','!=','0')
                ->orderBy('user_accounts.id','desc')
                ->select('user_personal_infos.name as approve_request_name','user_accounts.id as approve_request_id','user_accounts.created_at as date','user_beca_details.current_unite as approve_request_unite')->get());
        });
        view()->share('title_logo',ContentTable::where('content_name','logo'));



    }
}
