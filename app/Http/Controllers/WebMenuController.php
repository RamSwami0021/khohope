<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\Menu_Categories;
use App\Models\Order;
use App\Models\Menu_Items;
use App\Models\SupCategorie;
use Illuminate\Http\Request;

class WebMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $username, $id)
    {
        $isChecked = $request->has('vegOnly') ? 'on' : 'off';
        $user = User::where('username', $username)->first();
        $categories = Menu_Categories::where('user_id', $user->id)->where('status', 'on')->get();


        if ($isChecked === 'on') {
            foreach ($categories as $category) {
                $category->menus = Menu_Items::where('categorie_id', $category->id)
                ->where('status', 'on')
                ->where('type', 'veg')
                ->where(function($query) use ($id) {
                    $query->where(function($q) use ($id) {
                        $q->where('supcategorie_id', 'like', '%,'.$id.',%')
                            ->orWhere('supcategorie_id', 'like', $id.',%')
                            ->orWhere('supcategorie_id', 'like', '%,'.$id);
                    })
                    ->orWhere('supcategorie_id', $id);
                })
                ->get();
            }
        } else {
            foreach ($categories as $category) {
                $category->menus =Menu_Items::where('categorie_id', $category->id)
                ->where('status', 'on')
                ->where(function($query) use ($id) {
                    $query->where(function($q) use ($id) {
                        $q->where('supcategorie_id', 'like', '%,'.$id.',%')
                            ->orWhere('supcategorie_id', 'like', $id.',%')
                            ->orWhere('supcategorie_id', 'like', '%,'.$id);
                    })
                    ->orWhere('supcategorie_id', $id);
                })
                ->get();

            }
        }
        $SupCategorie = SupCategorie::where('user_id', $user->id)->where('status','on')->get();
        // dd($categories);
        return view('menu', compact('user', 'categories', 'isChecked', 'id','SupCategorie'));
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
        if (session()->has('customer')) {
            return $this->addtocart($request);
        } else {
            session()->flash('showModal', true);
        $request->flash();
        return redirect()->back();
        }
    }

    public function customer(Request $request)
    {
        $existingCustomer = Customer::where('mobile_number', $request->input('mobile_number'))->first();

        if ($existingCustomer) {
            session(['customer' => $existingCustomer]);
        } else {
            $customer = new Customer([
                'name' => $request->input('name'),
                'mobile_number' => $request->input('mobile_number'),
            ]);
            $customer->save();
            session(['customer' => $customer]);
        }
        return $this->addtocart($request);
    }

    public function addtocart(Request $request)
    {
        // dd('welcome');
        $customer_id = session('customer')->id;
        $existingOrder = Order::where('menu_id', $request->input('menu_id'))->where('customer_id',$customer_id)
            ->where('status', 'cart')
            ->first();

        if ($existingOrder) {
            $existingOrder->quantity += $request->input('quantity');
            $existingOrder->save();
            return redirect()->back()->with('success', 'Quantity updated in the cart successfully.');
        } else {
            $cart = new Order([
                'menu_id' => $request->input('menu_id'),
                'customer_id' => $customer_id,
                'quantity' => $request->input('quantity'),
                'user_id' => $request->input('user_id'),
                'price' => $request->input('price'),
                'status' => 'cart'
            ]);
            $cart->save();
            return redirect()->back()->with('success', 'Order added to cart successfully.');
        }
    }



    // public function store(Request $request)
    // {
    //     $existingOrder = Order::where('menu_id', $request->input('menu_id'))
    //         ->where('status', 'cart')
    //         ->first();

    //     if ($existingOrder) {
    //         $existingOrder->quantity += $request->input('quantity');
    //         $existingOrder->save();
    //         return redirect()->back()->with('success', 'Quantity updated in the cart successfully.');
    //     } else {
    //         $cart = new Order([
    //             'menu_id' => $request->input('menu_id'),
    //             'customer_id' => $request->input('customer_id'),
    //             'quantity' => $request->input('quantity'),
    //             'user_id' => $request->input('user_id'),
    //             'price' => $request->input('price'),
    //             'status' => 'cart'
    //         ]);
    //         $cart->save();
    //         return redirect()->back()->with('success', 'Order added to cart successfully.');
    //     }
    // }

    /**
     * Display the specified resource.
     */


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
        //
    }
}
