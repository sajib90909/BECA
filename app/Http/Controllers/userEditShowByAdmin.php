<?php

namespace App\Http\Controllers;

use App\MemberType;
use App\unites;
use App\User;
use App\UserAccount;
use App\UserAddressInfo;
use App\UserBecaDetails;
use App\UserCadetDetails;
use App\UserContactInfo;
use App\UserEducationProfession;
use App\UserPersonalInfo;
use App\UserVerificationDoc;
use Illuminate\Http\Request;

class userEditShowByAdmin extends Controller
{
    public function editBecaDetails($members_id){
        $beca_details = UserBecaDetails::where('user_id','=',$members_id)->first();
        $current_members_type = UserAccount::select('member_type')->where('id', $members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        $unites = unites::all();
        $members_type = MemberType::all();
        return view('admin-panel.members.editBecaDetails',['beca_details'=>$beca_details,
            'members_name'=>$personal_info,'unites'=>$unites,'members_type'=>$members_type,
            'current_members_type'=>$current_members_type]);
    }
    public function editPersonalInfo($members_id){
        $personal_info = UserPersonalInfo::where('user_id', $members_id)->first();
        return view('admin-panel.members.editPersonalInfo',['personal_info'=>$personal_info]);
    }
    public function editCadetDetails($members_id){
        $cadet_details = UserCadetDetails::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('admin-panel.members.editCadetDetails',['cadet_details'=>$cadet_details,'personal_info'=>$personal_info]);
    }
    public function editContactDetails($members_id){
        $contact_details = UserContactInfo::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('admin-panel.members.editContactDetails',['contact_details'=>$contact_details,'personal_info'=>$personal_info]);
    }
    public function editEduPro($members_id){
        $edu_pro_details = UserEducationProfession::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('admin-panel.members.editEduPro',['edu_pro_details'=>$edu_pro_details,'personal_info'=>$personal_info]);
    }
    public function editDoc($members_id){
        $doc_files = UserVerificationDoc::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('admin-panel.members.editDoc',['doc_files'=>$doc_files,'personal_info'=>$personal_info]);
    }
    public function editAddressDetails($members_id){
        $address_details = UserAddressInfo::where('user_id','=',$members_id)->first();
        $personal_info = UserPersonalInfo::select('name')->where('user_id', $members_id)->first();
        return view('admin-panel.members.editAddressDetails',['address_details'=>$address_details,'personal_info'=>$personal_info]);
    }
    public function editAccountSettings($members_id){
        $account_info = UserAccount::find($members_id);
        $image = UserPersonalInfo::select('profile_image','name')->where('user_id', $members_id)->first();
        return view('admin-panel.members.editAccountSettings',['image'=>$image,'account_info'=>$account_info]);
    }
}
