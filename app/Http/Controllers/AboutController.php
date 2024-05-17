<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\SupCategorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();
        $data = About::Where('user_id',$user->id)->get()->first();
        $SupCategorie = SupCategorie::where('user_id', $user->id)->where('status','on')->get();
        return view('about', compact('SupCategorie','user','data'));
    }
    public function about()
    {
        $userId = Auth::id();
        $data = About::Where('user_id',$userId)->get()->first();
        return view('admin/about',compact('data'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        $data = new About();
        $data->description = $request->description;
        $data->user_id = $userId;
        $data->save();

        return redirect()->back()->with('success', 'Menu Category add successfully.');
    }
}
