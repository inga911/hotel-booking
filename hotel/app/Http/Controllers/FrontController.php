<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function index()
    {
        $bookArea = BookArea::all();
        return view('frontend.index', [
            'bookArea' => $bookArea,
        ]);
    }


    public function editProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.user.edit-profile', compact('user'));
    }

    public function userStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();

        return redirect()->back();
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function userChangePassword()
    {
        return view('frontend.user.change-password');
    }

    public function userChangePasswordStore(Request $request)
    {
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        // if (!Hash::check($request->old_password, auth::user()->password)) {

        //     $notification = array(
        //         'message' => 'Old Password Does not Match!',
        //         'alert-type' => 'error'
        //     );

        //     return back()->with($notification);
        // }

        /// Update The New Password 
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);



        // $notification = array(
        //     'message' => 'Password Change Successfully',
        //     'alert-type' => 'success'
        // );

        return back();
    }
}
