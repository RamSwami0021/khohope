<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SupCategorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();
        $data = Contact::Where('user_id', $user->id)->get()->first();
        $SupCategorie = SupCategorie::where('user_id', $user->id)->where('status', 'on')->get();
        return view('contact', compact('SupCategorie', 'user', 'data'));
    }
    public function contact()
    {
        $userId = Auth::id();
        $data = Contact::Where('user_id', $userId)->get()->first();
        return view('admin/contact', compact('data'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        $contact = Contact::where('user_id', $userId)->first();

        if ($contact) {
            $contact->update([
                'email' => $request->email,
                'phone' => $request->phone,
                'website' => $request->website,
                'map' => $request->map,
            ]);
        } else {
            $contact = new Contact([
                'email' => $request->email,
                'phone' => $request->phone,
                'website' => $request->website,
                'map' => $request->map,
                'user_id' => $userId,
            ]);
            $contact->save();
        }

        return redirect()->back()->with('success', 'Menu Category add successfully.');
    }
}
