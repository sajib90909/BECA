<?php

namespace App\Http\Controllers;

use App\doc_verification_need;
use App\UserAccount;
use App\UserAddressInfo;
use App\UserBecaDetails;
use App\UserCadetDetails;
use App\UserContactInfo;
use App\UserEducationProfession;
use App\UserPersonalInfo;
use App\UserVerificationDoc;
use Illuminate\Http\Request;

class firstLoginActions extends Controller
{
    public function personal_info_save(Request $request){

        $this->validate($request,[
            'spouse_name' => 'max:50',
            'father_name' => 'required|max:50',
//            'mother_name' => 'required|max:50',
            'gender' => 'required|max:10',
            'blood' => 'required|max:10',
//            'height' => 'required|max:20',
            'religion' => 'required|max:20',
//            'birth_date' => '',
            'nid_pass' => 'required|numeric',
//            'driving_lic' => 'required',
        ]);
        $personal_info = UserPersonalInfo::where('user_id','=',$request->session()->get('members_id'))->first();
//        $personal_info->user_id = $request->session()->get('members_id');
//        $personal_info->name = $request->name;
        $personal_info->spouse_name = $request->spouse_name;
        $personal_info->father_name = $request->father_name;
        $personal_info->mother_name = $request->mother_name;
        $personal_info->gender = $request->gender;
        $personal_info->blood = $request->blood;
        $personal_info->height = $request->height;
        $personal_info->religion = $request->religion;
        $personal_info->birth_date = $request->birth_date;
        $personal_info->nid_pass = $request->nid_pass;
        $personal_info->driving_lic = $request->driving_lic;
        $personal_info->check = 1;
        $personal_info->save();

        return redirect('/user_panel/user_details');
    }
    public function address_details_save(Request $request){

        $this->validate($request,[
            'present_upazila' => 'required',
            'present_district' => 'required',
            'present_division' => 'required',
            'permanent_upazila' => 'required',
            'permanent_district' => 'required',
            'permanent_division' => 'required',
        ]);
        $address_details = UserAddressInfo::where('user_id','=',$request->session()->get('members_id'))->first();
        $address_details->user_id = $request->session()->get('members_id');
        $address_details->present_house = $request->present_house;
        $address_details->present_village = $request->present_village;
        $address_details->present_upazila = $request->present_upazila;
        $address_details->present_district = $request->present_district;
        $address_details->present_division = $request->present_division;
        $address_details->permanent_house = $request->permanent_house;
        $address_details->permanent_village = $request->permanent_village;
        $address_details->permanent_upazila = $request->permanent_upazila;
        $address_details->permanent_district = $request->permanent_district;
        $address_details->permanent_division = $request->permanent_division;
        $address_details->check = 1;
        $address_details->save();

        return redirect('/user_panel/user_details');
    }
    public function edu_pro_details_save(Request $request){

        $this->validate($request,[
            'ssc_batch' => 'required',
            'edu_qualification' => 'required',
            'profession' => 'required',
            'work_address' => 'required',
        ]);
        $edu_pro = UserEducationProfession::where('user_id','=',$request->session()->get('members_id'))->first();
        $edu_pro->user_id = $request->session()->get('members_id');
        $edu_pro->ssc_batch = $request->ssc_batch;
        $edu_pro->edu_qualification = $request->edu_qualification;
        $edu_pro->profession = $request->profession;
        $edu_pro->work_address = $request->work_address;
        $edu_pro->check = 1;
        $edu_pro->save();

        return redirect('/user_panel/user_details');
    }
    public function cadet_details_save(Request $request){

        $this->validate($request,[
            'institute_name' => 'required',
            'institute_address' => 'required',
            'regiment' => 'required',
            'cadet_rank' => 'required',
            'cadet_wing' => 'required',
            'cadet_ship_year' => 'required',
//            'registration_unite' => 'required',
//            'current_unite' => 'required'
        ]);
        $cadet_details = UserCadetDetails::where('user_id','=',$request->session()->get('members_id'))->first();
        $cadet_details->user_id = $request->session()->get('members_id');
        $cadet_details->institute_name = $request->institute_name;
        $cadet_details->institute_address = $request->institute_address;
        $cadet_details->cadet_id = $request->cadet_id;
        $cadet_details->regiment = $request->regiment;
        $cadet_details->cadet_rank = $request->cadet_rank;
        $cadet_details->cadet_wing = $request->cadet_wing;
        $cadet_details->cadet_ship_year = $request->cadet_ship_year;
        $cadet_details->check = 1;
        $cadet_details->save();

//        $beca_details = UserBecaDetails::where('user_id','=',$request->session()->get('members_id'))->first();
//        $beca_details->user_id = $request->session()->get('members_id');
//        $beca_details->registration_unite = $request->registration_unite;
//        $beca_details->current_unite = $request->current_unite;
//        $beca_details->check = 0;
//        $beca_details->save();

        return redirect('/user_panel/user_details');
    }
    public function contact_info_save(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);
        $contact_info = UserContactInfo::where('user_id','=',$request->session()->get('members_id'))->first();
        $contact_info->user_id = $request->session()->get('members_id');
        $contact_info->secondary_number = $request->secondary_number;
        $contact_info->emergency_number = $request->emergency_number;
        $contact_info->email = $request->email;
        $contact_info->facebook = $request->facebook;
        $contact_info->twitter = $request->twitter;
        $contact_info->skype = $request->skype;
        $contact_info->check = 1;
        $contact_info->save();


        $profile_image_name = $request->session()->get('members_id').'_'.rand(1, 10000).'_profile_image.'.$request->file('profile_image')->extension();
        $upload_folder = 'members_profile_photo/';
        $file_url = $upload_folder.$profile_image_name;
        $request->profile_image->move('user_panel/'.$upload_folder,$profile_image_name);
        $personal_info = UserPersonalInfo::where('user_id','=',$request->session()->get('members_id'))->first();
        $personal_info->profile_image = $file_url;
        $personal_info->save();

        $verfication_doc = UserVerificationDoc::where('user_id','=',$request->session()->get('members_id'))->first();
        $verfication_doc->user_id = $request->session()->get('members_id');
        $verfication_doc->check = 1;
        $verfication_doc->save();

        return redirect('/user_panel/user_details');
    }
    public function verify_doc(Request $request){
        $check_data = doc_verification_need::where('user_id',$request->session()->get('members_id'))->first();
        $documents = UserVerificationDoc::where('user_id',$request->session()->get('members_id'))->first();
        $this->validate($request,[
            'user_nid_pass_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
            'user_cadet_certificate_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
            'user_beca_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
        ]);
        if($check_data->user_nid_pass_doc == 1){
            $this->validate($request,[
                'user_nid_pass_doc' => 'required',
            ]);
        }
        if($check_data->user_cadet_certificate_doc == 1){
            $this->validate($request,[
                'user_cadet_certificate_doc' => 'required',
            ]);
        }
        if($check_data->user_beca_doc == 1){
            $this->validate($request,[
                'user_beca_doc' => 'required',
            ]);
        }
        $check = false;
        if($request->hasFile('user_nid_pass_doc')){
            $user_nid = $request->session()->get('members_id').'_'.rand(1, 10000).'_nid.'.$request->file('user_nid_pass_doc')->extension();
            $upload_folder = 'uploaded_document/';
            $file_url = $upload_folder.$user_nid;
            if(!empty($documents->user_nid_pass_doc)){
                unlink('user_panel/'.$documents->user_nid_pass_doc);
            }
            $request->user_nid_pass_doc->move('user_panel/'.$upload_folder,$user_nid);
            $documents->user_nid_pass_doc = $file_url;
            $check = true;
        }
        if($request->hasFile('user_cadet_certificate_doc')){
            $user_nid = $request->session()->get('members_id').'_'.rand(1, 10000).'_cadet.'.$request->file('user_cadet_certificate_doc')->extension();
            $upload_folder = 'uploaded_document/';
            $file_url = $upload_folder.$user_nid;
            if(!empty($documents->user_cadet_certificate_doc)){
                unlink('user_panel/'.$documents->user_cadet_certificate_doc);
            }
            $request->user_cadet_certificate_doc->move('user_panel/'.$upload_folder,$user_nid);
            $documents->user_cadet_certificate_doc = $file_url;
            $check = true;
        }
        if($request->hasFile('user_beca_doc')){
            $user_nid = $request->session()->get('members_id').'_'.rand(1, 10000).'_beca.'.$request->file('user_beca_doc')->extension();
            $upload_folder = 'uploaded_document/';
            $file_url = $upload_folder.$user_nid;
            if(!empty($documents->user_beca_doc)){
                unlink('user_panel/'.$documents->user_beca_doc);
            }
            $request->user_beca_doc->move('user_panel/'.$upload_folder,$user_nid);
            $documents->user_beca_doc = $file_url;
            $check = true;
        }
        if($check){
            $account = UserAccount::find($request->session()->get('members_id'));
            $account->check_doc = 1;
            $documents->check = 1;
            $account->save();
            $documents->save();
            $check_data->delete();
        }

        return redirect('/user_panel/user_details')->with('message','Submitted successfully');
    }
}
