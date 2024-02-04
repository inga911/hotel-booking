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
        $messagesCount = Contact::count();
        return view('admin.index', compact('admin', 'messagesCount'));
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
    public function requestMessage(Request $request)
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        $sort = $request->sort ?? 'default';

        $query = Contact::query();

        switch ($sort) {
            case 'created_at_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'created_at_desc':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $sortMessages = $query->paginate(6);

        return view('admin.contact.request-message', [
            'admin' => $admin,
            'sortMessages' => $sortMessages,
            'sort' => $sort
        ]);
    }

    public function deleteMessage($id)
    {
        $message = Contact::find($id);

        if ($message) {
            $message->delete();
            return back()->with('success', 'Message deleted successfully.');
        }
        return back()->with('error', 'Message not found.');
    }
}
