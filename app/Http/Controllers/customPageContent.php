<?php

namespace App\Http\Controllers;

use App\ContentTable;
use App\User;
use Illuminate\Http\Request;

class customPageContent extends Controller
{
    public function pageContent($action, Request $request)
    {
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $title = '';
        $update_by = '';
        if($action == 'logo'){
            $content_data = ContentTable::where('content_name','logo')->first();
            if($content_data){
                $update_by_data = User::find($content_data->edited_by);
                $update_by = $update_by_data->name;
            }
            $title = 'Logo Update';
        }elseif($action == 'header'){
            $content_data = ContentTable::where('content_name','header')->first();
            if($content_data){
                $update_by_data = User::find($content_data->edited_by);
                $update_by = $update_by_data->name;
            }
            $title = 'Header Content Update';
        }elseif ($action == 'help'){
            $content_data = ContentTable::where('content_name','help')->first();
            if($content_data){
                $update_by_data = User::find($content_data->edited_by);
                $update_by = $update_by_data->name;
            }
            $title = 'help Page Content Update';
        }elseif ($action == 'contact'){
            $content_data = ContentTable::where('content_name','contact')->first();
            if($content_data){
                $update_by_data = User::find($content_data->edited_by);
                $update_by = $update_by_data->name;
            }
            $title = 'Contact Page Content Update';
        }elseif ($action == 'membership'){
            $content_data = ContentTable::where('content_name','membership')->first();
            if($content_data){
                $update_by_data = User::find($content_data->edited_by);
                $update_by = $update_by_data->name;
            }
            $title = 'Membership Page Content Update';
        }elseif ($action == 'donation'){
            $content_data = ContentTable::where('content_name','donation')->first();
            if($content_data){
                $update_by_data = User::find($content_data->edited_by);
                $update_by = $update_by_data->name;
            }
            $title = 'Donation Page Content Update';
        }elseif ($action == 'head_notice'){
            $content_data = ContentTable::where('content_name','head_notice')->first();
            if($content_data){
                $update_by_data = User::find($content_data->edited_by);
                $update_by = $update_by_data->name;
            }
            $title = 'Notice Update';
        }else{
            exit();
        }
        return view('admin-panel.content.content',['action'=>$action,'title'=>$title,'content_data'=>$content_data,'update_by'=>$update_by]);
    }
    public function pageContentAction(Request $request){
        if((($request->session()->get('admin_type') != 'super') && ($request->session()->get('admin_type') != 'author'))
            || empty($request->session()->get('admin_type'))){
            return redirect('/admin_panel/login');
        }
        $this->validate($request,[
            'action' => 'required',
        ]);
        if($request -> action == 'logo'){
            $this->validate($request,[
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);
            $logo = 'logo.'.$request->file('logo')->extension();
            $upload_folder = 'site_uploads/';
            $file_url = $upload_folder.$logo;
            $content_data = ContentTable::where('content_name','logo')->first();
            if(!empty($content_data)){
                if(!empty($content_data->content_details)){
                    unlink('admin-panel/'.$content_data->content_details);
                }
                $content_data->content_details = $file_url;
                $content_data->edited_by = $request->session()->get('admin_id');
                $content_data->save();
            }else{
                $content_logo = new ContentTable();
                $content_logo->content_name = 'logo';
                $content_logo->content_details = $file_url;
                $content_logo->edited_by = $request->session()->get('admin_id');
                $content_logo->save();
            }
            $request->logo->move('admin-panel/'.$upload_folder,$logo);
        }else{
            $this->validate($request,[
                'description' => 'required',
            ]);
            if($request->action == 'header' || $request->action == 'help' || $request->action == 'head_notice' || $request->action == 'contact' || $request->action == 'membership' || $request->action == 'donation'){
                $content_data = ContentTable::where('content_name',$request->action)->first();
                if(empty($content_data)){
                    $content_data = new ContentTable();
                    $content_data->content_name = $request->action;
                }
                $content_data->content_details = $request->description;
                $content_data->edited_by = $request->session()->get('admin_id');
                $content_data->save();
            }else{
                exit();
            }

        }
        return redirect('/admin_panel/custom_page/'.$request->action)->with('message','Update Successful');
    }
}
