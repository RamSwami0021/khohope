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
        $data = Contact::Where('user_id',$user->id)->get()->first();
        $SupCategorie = SupCategorie::where('user_id', $user->id)->where('status','on')->get();
        return view('contact', compact('SupCategorie','user','data'));
    }
    public function contact()
    {
        $userId = Auth::id();
        $data = Contact::Where('user_id',$userId)->get()->first();
        return view('admin/contact',compact('data'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        $data = new Contact();
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->website = $request->website;
        $data->map = $request->map;
        $data->user_id = $userId;
        $data->save();

        return redirect()->back()->with('success', 'Menu Category add successfully.');
    }
}
