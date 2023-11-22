<?php

namespace App\Http\Controllers;

use App\Models\SmtpSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function smtpSetting()
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        $smtp = SmtpSetting::find(1);

        return view('admin.setting.smtp-update', compact('smtp', 'admin'));
    }

    public function smtpUpdate(Request $request)
    {
        $smtp_id = $request->id;
        SmtpSetting::find($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);
        $notification = array(
            'success' => 'Information Updated Successfully'
        );
        return redirect()->back()->with($notification);
    }
}
