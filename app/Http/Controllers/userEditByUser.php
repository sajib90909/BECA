<?php

namespace App\Http\Controllers;

use App\UserAccount;
use App\UserAddressInfo;
use App\UserBecaDetails;
use App\UserCadetDetails;
use App\UserContactInfo;
use App\UserEducationProfession;
use App\UserPersonalInfo;
use App\UserVerificationDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class userEditByUser extends Controller
{
    public function changePhone(Request $request){
        $this->validate($request,[
            'phone' => 'required|unique:user_accounts',
        ]);
        //        $otp_code = rand(10000,99999);
        $otp_code = 12345;
        $otp_code_encrypt = Crypt::encrypt($otp_code);
        $msg = 'BECA (Bangladesh Ex-Cadet Association) send you a verification code '.$otp_code;
        //        smsSend::send_sms($request->phone,$msg);
        $user_id = $request->session()->get('members_id');
        $account_info = UserAccount::find($user_id);
        $vpdx = Crypt::encrypt($request->phone);
        $image = UserPersonalInfo::select('profile_image','check')->where('user_id',$user_id)->first();
        return view('user-panel.account_settings.account_settings',['vpdxs'=>$vpdx,'phone'=>$request->phone,'otp'=>$otp_code_encrypt,'account_info'=>$account_info,'image'=>$image]);
    }
    public function changePhoneVerify(Request $request){
        $otp = Crypt::decrypt($request->otp);
        $request->vpdxs = Crypt::decrypt($request->vpdxs);
        $this->validate($request,[
            'code' => 'required|in:'.$otp,
            'otp' => 'required',
            'vpdxs' => 'required'
        ]);

        $account = UserAccount::find($request->session()->get('members_id'));
        $account->phone = $request->vpdxs;
        $account->save();
        return redirect('/user_panel/account_settings')->with('message','Update Successfully done!');
    }
    public function changePass(Request $request){
        $user_id = $request->session()->get('members_id');
        $this->validate($request,[
            'old_pass' => 'required',
            'password' => 'required|confirmed|min:6|max:25',
        ]);
        $user_data = UserAccount::find($user_id);

        if(!empty($user_data) && password_verify($request->old_pass,$user_data->password)){
            $user_data->password = Hash::make($request->password);
            $user_data->save();
            return redirect('/user_panel/account_settings')->with('message','Update Successfully done!');
        }else{
            return redirect('/user_panel/account_settings')->with('error_massage','Wrong Password!!');
        }
    }
    public function changeImage(Request $request){
        $this->validate($request,[
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);
        $profile_image_name = $request->session()->get('members_id').'_'.rand(1, 10000).'_profile_image.'.$request->file('profile_image')->extension();
        $upload_folder = 'members_profile_photo/';
        $file_url = $upload_folder.$profile_image_name;
        $personal_info = UserPersonalInfo::where('user_id',$request->session()->get('members_id'))->first();
        if (!empty($personal_info->profile_image)){
            unlink('user_panel/'.$personal_info->profile_image);
        }
        $request->profile_image->move('user_panel/'.$upload_folder,$profile_image_name);
        $personal_info->profile_image = $file_url;
        $personal_info->save();
        return redirect('/user_panel/account_settings')->with('message','Update Successfully done!');
    }
    public function editPersonalInfo(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'father_name' => 'required|max:50',
            'mother_name' => 'required|max:50',
            'gender' => 'required|max:10',
            'blood' => 'required|max:10',
            'height' => 'required|max:20',
            'religion' => 'required|max:20',
            'birth_date' => 'required',
            'nid_pass' => 'required|numeric',
        ]);
        $user_id = $request->session()->get('members_id');
        $personal_info = UserPersonalInfo::where('user_id', $user_id)->first();
        if($personal_info->check == 0){
            $personal_info->name = $request->name;
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
            return redirect()->route('/user_panel/user_details')->with('message','Update Successfully done');
        }else{
            return redirect()->route('/user_panel/user_details')->with('error_message','You are not able to do this action!');
        }

    }

    public function editCadetDetails(Request $request)
    {
        $this->validate($request,[
            'institute_name' => 'required',
            'institute_address' => 'required',
            'regiment' => 'required',
            'cadet_rank' => 'required',
            'cadet_wing' => 'required',
            'cadet_ship_year' => 'required',
        ]);
        $user_id = $request->session()->get('members_id');
        $cadet_details = UserCadetDetails::where('user_id', $user_id)->first();
        if($cadet_details->check == 0){
            $cadet_details->institute_name = $request->institute_name;
            $cadet_details->institute_address = $request->institute_address;
            $cadet_details->cadet_id = $request->cadet_id;
            $cadet_details->regiment = $request->regiment;
            $cadet_details->cadet_rank = $request->cadet_rank;
            $cadet_details->cadet_wing = $request->cadet_wing;
            $cadet_details->cadet_ship_year = $request->cadet_ship_year;
            $cadet_details->check = 1;
            $cadet_details->save();
            return redirect()->route('/user_panel/user_details')->with('message','Update Successfully done');
        }else{
            return redirect()->route('/user_panel/user_details')->with('error_message','You are not able to do this action!');
        }
    }

    public function editContactDetails(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
        ]);
        $user_id = $request->session()->get('members_id');
        $contact_info = UserContactInfo::where('user_id', $user_id)->first();
        if($contact_info->check == 0){
            $contact_info->secondary_number = $request->secondary_number;
            $contact_info->emergency_number = $request->emergency_number;
            $contact_info->email = $request->email;
            $contact_info->facebook = $request->facebook;
            $contact_info->twitter = $request->twitter;
            $contact_info->skype = $request->skype;
            $contact_info->check = 1;
            $contact_info->save();
            return redirect()->route('/user_panel/contact_info')->with('message','Update Successfully done');
        }else{
            return redirect()->route('/user_panel/contact_info')->with('error_message','You are not able to do this action!');
        }

    }

    public function editEduPro(Request $request)
    {
        $this->validate($request,[
            'ssc_batch' => 'required',
            'edu_qualification' => 'required',
            'profession' => 'required',
            'work_address' => 'required',
        ]);
        $user_id = $request->session()->get('members_id');
        $edu_pro = UserEducationProfession::where('user_id', $user_id)->first();
        if($edu_pro->check == 0){
            $edu_pro->ssc_batch = $request->ssc_batch;
            $edu_pro->edu_qualification = $request->edu_qualification;
            $edu_pro->profession = $request->profession;
            $edu_pro->work_address = $request->work_address;
            $edu_pro->check = 1;
            $edu_pro->save();
            return redirect()->route('/user_panel/user_details')->with('message','Update Successfully done');
        }else{
            return redirect()->route('/user_panel/user_details')->with('error_message','You are not able to do this action!');
        }


    }

    public function editDoc(Request $request)
    {
        $documents = UserVerificationDoc::where('user_id',$request->session()->get('members_id'))->first();
        if($documents->check == 0){
            $this->validate($request,[
                'user_nid_pass_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
                'user_cadet_certificate_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
                'user_beca_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
            ]);
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
            }
            return redirect()->route('/user_panel/verification_doc',['user_id'=>$request->user_id])->with('message','Update Successfully done');
        }else{
            return redirect()->route('/user_panel/verification_doc')->with('error_message','You are not able to do this action!');
        }


    }

    public function editAddressDetails(Request $request)
    {
        $this->validate($request,[
            'present_upazila' => 'required',
            'present_district' => 'required',
            'present_division' => 'required',
            'permanent_upazila' => 'required',
            'permanent_district' => 'required',
            'permanent_division' => 'required',
        ]);
        $user_id = $request->session()->get('members_id');
        $address_details = UserAddressInfo::where('user_id', $user_id)->first();
        if($address_details->check == 0){
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
            return redirect()->route('/user_panel/user_details')->with('message','Update Successfully done');
        }else{
            return redirect()->route('/user_panel/user_details')->with('error_message','You are not able to do this action!');
        }


    }
}
