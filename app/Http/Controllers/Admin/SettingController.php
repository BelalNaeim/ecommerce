<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function SiteSetting()
    {
        $setting = DB::table('sitesetting')->first();
        return view('admin.setting.site_setting', compact('setting'));
    }

    public function UpdateSiteSetting(Request $request)
    {
        $id = $request->id;
   
        $data = array();
        $data['phone'] = $request->phone;
        $data['mobile'] = $request->mobile;
        $data['email'] = $request->email;
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['facebook'] = $request->facebook;
        $data['youtube'] = $request->youtube;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        DB::table('sitesetting')->where('id', $id)->update($data);
        $notification=array(
               'messege'=>'Site Setting Updated Successfully',
               'alert-type'=>'success'
                );
        return Redirect()->back()->with($notification);
    }
}
