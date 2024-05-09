<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Theme::all();

        // dd($list);
        return view('admin/theme', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $userId = Auth::id();
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->theme_id = $id;
        $user->save();

        return redirect()->back()->with('success', 'Theme Chenge successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
