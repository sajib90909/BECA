<?php

namespace App\Http\Controllers;

use App\ContentTable;
use App\MemberType;
use App\unites;
use App\UserAccount;
use App\UserAddressInfo;
use App\UserBecaDetails;
use App\UserCadetDetails;
use App\UserContactInfo;
use App\UserEducationProfession;
use App\UserPaymentDetails;
use App\UserPersonalInfo;
use App\UserVerificationDoc;
use Illuminate\Http\Request;

class userPanelController extends Controller
{
    public function user_details_show(Request $request)
    {
        $user_id = $request->session()->get('members_id');
        $account_info = UserAccount::find($user_id);
        $personal_info = UserPersonalInfo::where('user_id',$user_id)->first();
        $address_details = UserAddressInfo::where('user_id',$user_id)->first();
        $edu_pro_details = UserEducationProfession::where('user_id',$user_id)->first();
        $cadet_details = UserCadetDetails::where('user_id',$user_id)->first();
        $beca_details = UserBecaDetails::where('user_id',$user_id)->first();
        $current_unite_find = unites::find($beca_details->current_unite);
        $current_unite = $current_unite_find->unite_name;
        $member_type_find= MemberType::find($account_info->member_type);
        $member_type_name = $member_type_find->type_name;
//        $registration_unite_find = unites::find($beca_details->registration_unite);
//        $registration_unite = $registration_unite_find->unite_name;
        return view('user-panel.user_panel.user_panel',['personal_info'=>$personal_info,
            'address_details'=>$address_details,
            'edu_pro_details'=>$edu_pro_details,
            'cadet_details' =>$cadet_details,
            'beca_details' =>$beca_details,
            'account_info' =>$account_info,
            'current_unite'=>$current_unite,
//            'registration_unite'=>$registration_unite,
            'member_type' => $member_type_name,
            ]);
    }
    public function contact_info_show(Request $request)
    {
        $user_id = $request->session()->get('members_id');
        $contact_details = UserContactInfo::where('user_id',$user_id)->first();
        return view('user-panel.contact_info.contact_info',['contact_details'=>$contact_details]);
    }
    public function payment_details_show(Request $request)
    {
        $user_id = $request->session()->get('members_id');
        $payment_info = UserPaymentDetails::where('user_id',$user_id)->get();
        return view('user-panel.payment_details.payment_details',['payment_info'=>$payment_info]);
    }
    public function account_settings_show(Request $request)
    {
        $user_id = $request->session()->get('members_id');
        $account_info = UserAccount::find($user_id);
        $image = UserPersonalInfo::select('profile_image','check')->where('user_id',$user_id)->first();
        return view('user-panel.account_settings.account_settings',['account_info'=>$account_info,'image'=>$image]);
    }
    public function verification_doc_show(Request $request)
    {
        $user_id = $request->session()->get('members_id');
        $verification_docs = UserVerificationDoc::where('user_id',$user_id)->first();
        return view('user-panel.verification_doc.verification_doc',['verification_docs'=>$verification_docs]);
    }
    public function help_show(){
        $content_data = ContentTable::where('content_name','help')->first();
        return view('user-panel.help',['content_data'=>$content_data]);
    }
}
