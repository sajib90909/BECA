<?php

namespace App\Http\Controllers;

use App\UserVerificationDoc;
use Illuminate\Http\Request;

class documentController extends Controller
{
    public function adminView($action,$member_id)
    {
        $member_doc = UserVerificationDoc::where('user_id',$member_id)->first();
        $document = $member_doc->$action;
        return view('document.docView',compact(['document']));
    }
    public function adminDownload($action,$member_id)
    {
        $member_doc = UserVerificationDoc::where('user_id',$member_id)->first();
        $document = $member_doc->$action;
        return response()->download('user_panel/'.$document);
    }
    public function userView(Request $request, $action)
    {
        $member_doc = UserVerificationDoc::where('user_id',$request->session()->get('members_id'))->first();
        $document = $member_doc->$action;
        return view('document.docView',compact(['document']));
    }
    public function userDownload(Request $request, $action)
    {
        $member_doc = UserVerificationDoc::where('user_id',$request->session()->get('members_id'))->first();
        $document = $member_doc->$action;
        return response()->download('user_panel/'.$document);
    }
}
