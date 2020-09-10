<?php

namespace App\Http\Controllers;

use App\activeLogAdmins;
use App\doc_verification_need;
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
use DB;
use Illuminate\Support\Facades\Hash;

class userEditByAdmin extends Controller
{
    public function activeLog($action_admin,$action_user_id,$action_details,$type){
        $active_log = new activeLogAdmins();
        $active_log->action_admin_id = $action_admin;
        $active_log->action_user_id = $action_user_id;
        $active_log->user_type = $type;
        $active_log->action_details = $action_details;
        $active_log->save();
    }
    public function unite_check($admin_type,$admin_unite_id,$user_id){
        if($admin_type == 'super' || $admin_type == 'author'){
            return true;
        }else{
            $data = UserBecaDetails::where('user_id',$user_id)->where('current_unite',$admin_unite_id)->count();
            if($data > 0){
                return true;
            }
        }
        return redirect('/admin_panel/login');

    }
    public function editBecaDetails(Request $request)
    {
        $this->validate($request,[
            'members_type' => 'required',
            'current_unite' => 'required',
            'user_id' => 'required',
        ]);

        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $beca_details = UserBecaDetails::where('user_id', $request->user_id)->first();

        if(empty($beca_details->beca_reg_id)){
            $current_members_type = UserAddressInfo::select('permanent_district')->where('user_id', $request->user_id)->first();
            $permanent_address_district = DB::table('districts')->where('name','=',$current_members_type->permanent_district)->first();
            $district_id = str_pad($permanent_address_district->id, 2, "0", STR_PAD_LEFT);
            $user_id_marge = str_pad($request->user_id, 4, "0", STR_PAD_LEFT);
            $beca_reg_id = $district_id.$user_id_marge.rand(100,999);
            $beca_details->beca_reg_id = $beca_reg_id;
        }

        $beca_details->current_unite = $request->current_unite;
        $beca_details->nec_member = $request->nec_member;
        $beca_details->position = $request->position;
        $beca_details->edited_by = $request->session()->get('admin_id');
        $beca_details->save();
        $user_account = UserAccount::where('id', $request->user_id)->first();
        $user_account->member_type = $request->members_type;
        if($user_account->status == 'not_check'){
            $user_account->status = 'approve';
        }

        $user_account->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users beca details name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
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
            'user_id' => 'required',
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $personal_info = UserPersonalInfo::where('user_id', $request->user_id)->first();
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
        $personal_info->edited_by = $request->session()->get('admin_id');
        $personal_info->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users personal information, name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
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
            'user_id' => 'required',
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $cadet_details = UserCadetDetails::where('user_id', $request->user_id)->first();
        $cadet_details->institute_name = $request->institute_name;
        $cadet_details->institute_address = $request->institute_address;
        $cadet_details->cadet_id = $request->cadet_id;
        $cadet_details->regiment = $request->regiment;
        $cadet_details->cadet_rank = $request->cadet_rank;
        $cadet_details->cadet_wing = $request->cadet_wing;
        $cadet_details->cadet_ship_year = $request->cadet_ship_year;
        $cadet_details->check = 1;
        $cadet_details->edited_by = $request->session()->get('admin_id');
        $cadet_details->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users cadet details, name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
    }

    public function editContactDetails(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'user_id' => 'required',
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $contact_info = UserContactInfo::where('user_id', $request->user_id)->first();
        $contact_info->secondary_number = $request->secondary_number;
        $contact_info->emergency_number = $request->emergency_number;
        $contact_info->email = $request->email;
        $contact_info->facebook = $request->facebook;
        $contact_info->twitter = $request->twitter;
        $contact_info->skype = $request->skype;
        $contact_info->check = 1;
        $contact_info->edited_by = $request->session()->get('admin_id');
        $contact_info->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users contact details, name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
    }

    public function editEduPro(Request $request)
    {
        $this->validate($request,[
            'ssc_batch' => 'required',
            'edu_qualification' => 'required',
            'profession' => 'required',
            'work_address' => 'required',
            'user_id' => 'required',
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $edu_pro = UserEducationProfession::where('user_id', $request->user_id)->first();
        $edu_pro->ssc_batch = $request->ssc_batch;
        $edu_pro->edu_qualification = $request->edu_qualification;
        $edu_pro->profession = $request->profession;
        $edu_pro->work_address = $request->work_address;
        $edu_pro->check = 1;
        $edu_pro->edited_by = $request->session()->get('admin_id');
        $edu_pro->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users education and profession ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
    }

    public function editDoc(Request $request)
    {

        $this->validate($request,[
            'user_id' => 'required',
            'user_nid_pass_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
            'user_cadet_certificate_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
            'user_beca_doc' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $check = false;
        $documents = UserVerificationDoc::where('user_id',$request->user_id)->first();
        if($request->hasFile('user_nid_pass_doc')){
            $user_nid = $request->user_id.'_'.rand(1, 10000).'_nid.'.$request->file('user_nid_pass_doc')->extension();
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
            $user_nid = $request->user_id.'_'.rand(1, 10000).'_cadet.'.$request->file('user_cadet_certificate_doc')->extension();
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
            $user_nid = $request->user_id.'_'.rand(1, 10000).'_beca.'.$request->file('user_beca_doc')->extension();
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
            $account = UserAccount::find($request->user_id);
            $account->check_doc = 1;
            $documents->check = 1;
            $documents->edited_by = $request->session()->get('admin_id');
            $account->save();
            $documents->save();
        }
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users documents, name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
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
            'user_id' => 'required',
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $address_details = UserAddressInfo::where('user_id', $request->user_id)->first();
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
        $address_details->edited_by = $request->session()->get('admin_id');
        $address_details->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users address, name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
    }
    public function editMemberStatus($members_id,$status,Request $request){
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$members_id);
        $user_account = UserAccount::find($members_id);
        if($user_account->status == 'not_check'){
            return redirect('/admin_panel/members/beca_details/edit/'.$members_id);
        } elseif($status == 'approve'){
            $user_account->status = 'approve';
        }elseif($status == 'deactivated'){
            $user_account->status = 'deactivated';
        }elseif($status == 'banned'){
            $user_account->status = 'banned';
        }else{
            $user_account->status = 'not_check';
        }
        $user_account->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $members_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a user member Status name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$members_id])->with('message','Update Successfully done');
    }
    public function editPermissionStatus($members_id,$action,$status,Request $request){
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$members_id);
        if($action == 'personal_info'){
            $target = UserPersonalInfo::where('user_id', $members_id)->first();
        }elseif($action == 'address_info'){
            $target = UserAddressInfo::where('user_id', $members_id)->first();
        }elseif($action == 'edu_pro_info'){
            $target = UserEducationProfession::where('user_id', $members_id)->first();
        }elseif($action == 'cadet_info'){
            $target = UserCadetDetails::where('user_id', $members_id)->first();
        }elseif($action == 'doc_info'){
            $target = UserVerificationDoc::where('user_id', $members_id)->first();
        }elseif($action == 'contact_info'){
            $target = UserContactInfo::where('user_id', $members_id)->first();
        }else{
            return redirect()->route('/admin_panel/members/details/',['user_id'=>$members_id]);
        }
        if($status == 'off'){
            $target->check = 1;
        }else{
            $target->check = 0;
        }
        $target->edited_by = $request->session()->get('admin_id');
        $target->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $members_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users edit permistion Status name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$members_id])->with('message','Update Successfully done');
    }
    public function editAcountinfo($members_id,$action,Request $request){
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$members_id);
        $target = UserAccount::find($members_id);
        if($action == 'check_doc_off'){
            $target->check_doc = 1;
            $doc_data = doc_verification_need::where('user_id',$members_id)->delete();
        }else{
            return redirect()->route('/admin_panel/members/details/',['user_id'=>$members_id]);
        }

        $target->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $members_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users account information, name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$members_id])->with('message','Update Successfully done');
    }
    public function editAcountinfo_check_doc(Request $request){
        $this->validate($request,[
            'user_id' => 'required|unique:doc_verification_needs',
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $check = false;
        $target = UserAccount::find($request->user_id);
        $doc_database = new doc_verification_need();
        $doc_database->user_id = $request->user_id;
        $doc_database->edited_by = $request->session()->get('admin_id');
        if($request->user_nid_pass_doc){
            $doc_database->user_nid_pass_doc = 1;
            $check = true;
        }
        if($request->user_cadet_certificate_doc){
            $doc_database->user_cadet_certificate_doc = 1;
            $check = true;
        }
        if($request->user_beca_doc){
            $doc_database->user_beca_doc = 1;
            $check = true;
        }
        if($check){
            $target->check_doc = 0;
            $target->save();
            $doc_database->save();
        }else{
            return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('error-message','Select at least one doc type');
        }
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users edit documment check Status, name ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
    }
    public function accountSettingsEdit(Request $request){
        $this->validate($request,[
            'user_id'=> 'required',
            'phone' => 'required|unique:user_accounts,phone,'.$request->user_id,
        ]);
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$request->user_id);
        $user_account = UserAccount::find($request->user_id);
        $user_account->phone = $request->phone;
        if($request->password){
            $this->validate($request,[
                'password' => 'required|max:25|min:6',
            ]);
            $user_account->password = Hash::make($request->password);
        }
        if($request->hasFile('profile_image')){
            $this->validate($request,[
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
            ]);
            $profile_image_name = $request->session()->get('members_id').'_'.rand(1, 10000).'_profile_image.'.$request->file('profile_image')->extension();
            $upload_folder = 'members_profile_photo/';
            $file_url = $upload_folder.$profile_image_name;
            $personal_info = UserPersonalInfo::where('user_id',$request->user_id)->first();
            if (!empty($personal_info->profile_image)){
                unlink('user_panel/'.$personal_info->profile_image);
            }
            $request->profile_image->move('user_panel/'.$upload_folder,$profile_image_name);
            $personal_info->profile_image = $file_url;
            $personal_info->save();
        }
        $user_account->edited_by = $request->session()->get('admin_id');
        $user_account->save();
        //        -----active_log----
        $active_log_action_admin = $request->session()->get('admin_id');
        $active_log_action_user_id = $request->user_id;
        $active_log_user_type = 'user';
        $active_log_action_details = 'Update a users account settings name: ';
        $this->activeLog($active_log_action_admin,$active_log_action_user_id,$active_log_action_details,$active_log_user_type);
//        -----end activelog-----
        return redirect()->route('/admin_panel/members/details/',['user_id'=>$request->user_id])->with('message','Update Successfully done');
    }

}
