<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu_Categories;
use Illuminate\Support\Facades\Log;


class Menu_CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $list = Menu_Categories::where('user_id', $userId)->latest()->get();
        return view('admin/listCategory', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/createCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $Categories = new Menu_Categories();
        $Categories->name = $request->name;
        if (!empty($request->status)) {
            $Categories->status = $request->status;
        } else {
            $Categories->status = "off";
        }
        $Categories->user_id = $userId;
        $Categories->save();

        return redirect()->back()->with('success', 'Menu Category add successfully.');
    }
    public function updateStatus(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        $item = Menu_Categories::find($itemId);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }


        $item->status = $status;
        $item->save();

        return response()->json(['message' => 'Status updated successfully']);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item = Menu_Categories::find($id);
        $item->delete();
        return redirect()->back()->with('success', 'Menu Category delete successfully.');
    }
}
