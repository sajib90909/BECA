<?php

namespace App\Http\Controllers;

use App\MemberType;
use App\unites;
use App\UserAccount;
use App\UserAddressInfo;
use App\UserBecaDetails;
use App\UserCadetDetails;
use App\UserContactInfo;
use App\UserEducationProfession;
use App\UserPersonalInfo;
use App\UserVerificationDoc;
use Illuminate\Http\Request;

class userEditShowByUser extends Controller
{

    public function editPersonalInfo(Request $request){
        $members_id = $request->session()->get('members_id');
        $personal_info = UserPersonalInfo::where('user_id', $members_id)->first();
        return view('user-panel.user_panel.edit_personal_info',['personal_info'=>$personal_info]);
    }
    public function editCadetDetails(Request $request){
        $members_id = $request->session()->get('members_id');
        $cadet_details = UserCadetDetails::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('user-panel.user_panel.edit_cadet_details',['cadet_details'=>$cadet_details,'personal_info'=>$personal_info]);
    }
    public function editContactDetails(Request $request){
        $members_id = $request->session()->get('members_id');
        $contact_details = UserContactInfo::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('user-panel.contact_info.edit_contact_info',['contact_details'=>$contact_details,'personal_info'=>$personal_info]);
    }
    public function editEduPro(Request $request){
        $members_id = $request->session()->get('members_id');
        $edu_pro_details = UserEducationProfession::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('user-panel.user_panel.edit_edu_pro',['edu_pro_details'=>$edu_pro_details,'personal_info'=>$personal_info]);
    }
    public function editDoc(Request $request){
        $members_id = $request->session()->get('members_id');
        $doc_files = UserVerificationDoc::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('user-panel.verification_doc.edit_doc',['doc_files'=>$doc_files,'personal_info'=>$personal_info]);
    }
    public function editAddressDetails(Request $request){
        $members_id = $request->session()->get('members_id');
        $address_details = UserAddressInfo::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('user-panel.user_panel.edit_address',['address_details'=>$address_details,'personal_info'=>$personal_info]);
    }
}
