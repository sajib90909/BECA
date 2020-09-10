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
use PDF;
use Illuminate\Http\Request;

class pdfController extends Controller
{
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
    public function printPDF(Request $request){
        $logo = ContentTable::where('content_name','logo')->first();
        $header = ContentTable::where('content_name','header')->first();
        $user_id = $request->session()->get('members_id');
        $account_info = UserAccount::find($user_id);
        $personal_info = UserPersonalInfo::where('user_id','=',$user_id)->first();
        $address_details = UserAddressInfo::where('user_id','=',$user_id)->first();
        $contact_details = UserContactInfo::where('user_id','=',$user_id)->first();
        $payment_info = UserPaymentDetails::where('user_id','=',$user_id)->get();
        $verification_docs = UserVerificationDoc::where('user_id','=',$user_id)->first();
        $edu_pro_details = UserEducationProfession::where('user_id','=',$user_id)->first();
        $cadet_details = UserCadetDetails::where('user_id','=',$user_id)->first();
        $beca_details = UserBecaDetails::where('user_id','=',$user_id)->first();
        $current_unite_find = unites::find($beca_details->current_unite);
        $current_unite = $current_unite_find->unite_name;
        $member_type_find= MemberType::find($account_info->member_type);
        $member_type_name = $member_type_find->type_name;
//        $registration_unite_find = unites::find($beca_details->registration_unite);
//        $registration_unite = $registration_unite_find->unite_name;
        $data = [
            'logo' => $logo->content_details,
            'header_content' => $header->content_details,
            'title' => 'Beca User Information',
            'heading' => '',
            'personal_info'=>$personal_info,
            'address_details'=>$address_details,
            'edu_pro_details'=>$edu_pro_details,
            'cadet_details' =>$cadet_details,
            'contact_details' =>$contact_details,
            'payment_info' =>$payment_info,
            'verification_docs'=>$verification_docs,
            'beca_details' =>$beca_details,
            'account_info' =>$account_info,
            'current_unite'=>$current_unite,
            'member_type' => $member_type_name,

            ];

        $pdf = PDF::loadView('user-panel.pdfTemplate', $data);
        $filename = $personal_info->name;
        $filename = strtolower($filename);
        $filename = str_replace(' ','_',$filename);

        return $pdf->stream($filename.'.pdf');
    }
    public function printPDFbyAdmin($members_id,Request $request){
        $logo = ContentTable::where('content_name','logo')->first();
        $header = ContentTable::where('content_name','header')->first();
        $user_id = $members_id;

        $beca_details = UserBecaDetails::where('user_id','=',$user_id)->first();
        $this->unite_check($request->session()->get('admin_type'),$request->session()->get('admin_unite_id'),$user_id);
        $account_info = UserAccount::find($user_id);
        $personal_info = UserPersonalInfo::where('user_id','=',$user_id)->first();
        $address_details = UserAddressInfo::where('user_id','=',$user_id)->first();
        $contact_details = UserContactInfo::where('user_id','=',$user_id)->first();
        $payment_info = UserPaymentDetails::where('user_id','=',$user_id)->get();
        $verification_docs = UserVerificationDoc::where('user_id','=',$user_id)->first();
        $edu_pro_details = UserEducationProfession::where('user_id','=',$user_id)->first();
        $cadet_details = UserCadetDetails::where('user_id','=',$user_id)->first();
        $current_unite_find = unites::find($beca_details->current_unite);
        $current_unite = $current_unite_find->unite_name;
        $member_type_find= MemberType::find($account_info->member_type);
        $member_type_name = $member_type_find->type_name;
//        $registration_unite_find = unites::find($beca_details->registration_unite);
//        $registration_unite = $registration_unite_find->unite_name;
        $data = [
            'logo' => $logo->content_details,
            'header_content' => $header->content_details,
            'title' => 'Beca User Information',
            'heading' => '',
            'personal_info'=>$personal_info,
            'address_details'=>$address_details,
            'edu_pro_details'=>$edu_pro_details,
            'cadet_details' =>$cadet_details,
            'contact_details' =>$contact_details,
            'payment_info' =>$payment_info,
            'verification_docs'=>$verification_docs,
            'beca_details' =>$beca_details,
            'account_info' =>$account_info,
            'current_unite'=>$current_unite,
            'member_type' => $member_type_name,

        ];

        $pdf = PDF::loadView('user-panel.pdfTemplate', $data);
        $filename = $personal_info->name;
        $filename = strtolower($filename);
        $filename = str_replace(' ','_',$filename);

        return $pdf->stream($filename.'.pdf');
    }
}
