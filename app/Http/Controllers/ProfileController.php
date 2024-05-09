<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        return view('admin/profile', compact('userId'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
        return redirect()->back();
    }
}
