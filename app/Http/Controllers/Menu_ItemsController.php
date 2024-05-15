<?php

namespace App\Http\Controllers;

use App\Models\Menu_Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu_Categories;
use App\Models\SupCategorie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;


class Menu_ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $list = Menu_Items::where('user_id', $userId)->orderBy('name')->get();
        return view('admin/listMenu', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();
        $hasSupCategories = SupCategorie::where('user_id', $userId)->exists();
        if (!$hasSupCategories) {
            return view('admin/createSupCategory');
        }
        $hasCategories = Menu_Categories::where('user_id', $userId)->exists();
        if (!$hasCategories) {
            return view('admin/createCategory');
        }
        $list = Menu_Categories::where('user_id', $userId)
            ->where('status', 'on')
            ->orderBy('name')
            ->get();
        $suplist = SupCategorie::where('user_id', $userId)
            ->where('status', 'on')
            ->orderBy('name')
            ->get();

        return view('admin.createMenu', ['list' => $list, 'suplist' => $suplist]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd(json_encode($request->supcategory));
        $userId = Auth::id();
        $items = new Menu_Items();
        $items->name = $request->name;
        $items->user_id = $userId;
        $items->type = $request->type;
        $items->categorie_id = $request->category;
        $selectedSuperCategories = $request->input('supcategories', []);
        $items->supcategorie_id = implode(', ', $selectedSuperCategories);
        $items->description = $request->short_description;
        $items->price = $request->price;
        if (!empty($request->status)) {
            $items->status = $request->status;
        } else {
            $items->status = "off";
        }
        $items->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'gallery_' . $items->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);
            $items->image_url = 'image/' . $imageName;
            $items->save();
        }

        return redirect()->back()->with('success', 'Menu add successfully.');
    }

    public function updateStatus(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        $item = Menu_Items::find($itemId);
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
        $userId = Auth::id();
        $list_category = Menu_Categories::where('user_id', $userId)
            ->where('status', 'on')
            ->latest()
            ->get();
        $suplist = SupCategorie::where('user_id', $userId)
            ->where('status', 'on')
            ->latest()
            ->get();
        $list_menu = Menu_Items::find($id);
        // dd($list_menu);
        return view('admin/editMenu', ['list' => $list_category, 'menu' => $list_menu, 'suplist' => $suplist]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $items = Menu_Items::findOrFail($id);
        $items->name = $request->name;
        $items->user_id = $userId;
        $items->type = $request->type;
        $items->categorie_id = $request->category;
        // $items->supcategorie_id = $request->supcategory;
        $selectedSuperCategories = $request->input('supcategories', []);
        $items->supcategorie_id = implode(', ', $selectedSuperCategories);
        $items->description = $request->short_description;
        $items->price = $request->price;

        $items->status = $request->status ? $request->status : "off";

        $oldImageUrl = $items->image_url;

        if ($request->hasFile('image')) {
            if ($oldImageUrl) {
                File::delete(public_path($oldImageUrl));
            }
            $image = $request->file('image');
            $imageName = 'gallery_' . $items->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);
            $items->image_url = 'image/' . $imageName;
        }

        $items->save();

        return redirect()->back()->with('success', 'Menu updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Menu_Items::find($id);

        if ($item->image_url) {
            $imagePath = public_path($item->image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $item->delete();
        return redirect()->back()->with('success', 'Menu delete successfully.');
    }
}
