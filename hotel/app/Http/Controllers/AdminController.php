<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.index', compact('admin'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.admin-profile', compact('admin'));
    }


    //Contact
    public function requestMessage()
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        $contact = Contact::latest()->get();
        return view('admin.contact.request-message', compact('contact', 'admin'));
    }
}
