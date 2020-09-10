<?php

namespace App\Http\Controllers;

use App\ContentTable;
use App\MemberType;
use App\Rules\Captcha;
use App\unites;
use Illuminate\Http\Request;
use DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class membersViewController extends Controller
{
    private function sessionRemove($request)
    {
        $request->session()->forget('members_login');
        $request->session()->forget('members_email');
        $request->session()->forget('members_id');
    }
    public function index(Request $request)
    {
        $this->sessionRemove($request);
        return view('members.home.home');
    }
    public function searchMembers(Request $request)
    {
        $this->sessionRemove($request);
        $action = 'default';
        return view('members.search.search',['action'=>$action]);
    }
    public function member_login(Request $request)
    {
        $this->sessionRemove($request);
        $action = 'login';
        return view('members.auth.login',compact(['action']));
    }
    public function forgetPassword(Request $request)
    {
        $this->sessionRemove($request);
        $action = 'forget_pass';
        return view('members.auth.login',compact(['action']));
    }
    public function member_registration(Request $request)
    {
        $this->sessionRemove($request);
        $unites = Unites::where('publish',1)->get();
        return view('members.auth.registration',['unites'=>$unites]);
    }
    public function membershipView(Request $request)
    {
        $this->sessionRemove($request);
        $content_data = ContentTable::where('content_name','membership')->first();
        return view('members.others.membership',['content_data'=>$content_data]);
    }
    public function contactView(Request $request)
    {
        $this->sessionRemove($request);
        $content_data = ContentTable::where('content_name','contact')->first();
        return view('members.others.contact',['content_data'=>$content_data]);
    }
    public function donationView(Request $request)
    {
        $this->sessionRemove($request);
        $content_data = ContentTable::where('content_name','donation')->first();
        return view('members.others.donation',['content_data'=>$content_data]);
    }
    public function searchResult(Request $request)
    {
        $this->sessionRemove($request);
        $this->validate($request,[
            'reg_number' => 'required',
            'g-recaptcha-response' => new Captcha(),
        ]);
        $action = 'search_result';
        $data = DB::table('user_accounts')
            ->join('user_personal_infos','user_accounts.id','=','user_personal_infos.user_id')
            ->join('user_contact_infos','user_accounts.id','=','user_contact_infos.user_id')
            ->join('user_beca_details','user_accounts.id','=','user_beca_details.user_id')
            ->join('user_address_infos','user_accounts.id','=','user_address_infos.user_id')
            ->join('member_types','user_accounts.member_type','=','member_types.id')
            ->join('unites','user_beca_details.current_unite','=','unites.id')
            ->where('user_beca_details.beca_reg_id','=',$request->reg_number)
            ->select('user_personal_infos.profile_image','unites.unite_name',
                'user_personal_infos.name','user_beca_details.beca_reg_id','member_types.type_name','user_address_infos.present_district')
            ->first();
        return view('members.search.search',['data'=>$data,'action'=>$action]);
    }
}
