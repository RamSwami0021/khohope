<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\customer;
use App\Models\Customer as ModelsCustomer;
use App\Models\Order;
use App\Models\Menu_Items;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SupCategorie;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($username)
    {
        if (!Session::has('customer')) {
            return redirect()->route('menu', ['username' => $username]);
        }
        $user = User::where('username', $username)->first();
        $customerList = session('customer');
        $orderCartList = Order::where('customer_id', $customerList->id)->where('user_id', $user->id)->where('status', 'cart')->with('menu')->get();

        $totalCartPlace = 0;
        foreach ($orderCartList as $order) {
            $totalCartPlace += $order->quantity * $order->price;
        }


        // $orderPlacedList = Order::where('customer_id', $customerList->id)->where('user_id',$user->id)->where('status','placed')->with('menu')->get();
        $orderPlacedList = Order::where('customer_id', $customerList->id)
            ->where('user_id', $user->id)
            ->whereIn('status', ['placed', 'preparing', 'serve', 'complete'])
            ->get();

        foreach ($orderPlacedList as $order) {
            $menu = Menu_Items::find($order->menu_id);

            $order->image_url = $menu->image_url;
            $order->name = $menu->name;
            $order->type = $menu->type;
        }

        $totalPlaced = 0;

        foreach ($orderPlacedList as $order) {
            $totalPlaced += $order->quantity * $order->price;
        }

        $SupCategorie = SupCategorie::where('user_id', $user->id)->where('status','on')->get();

        return view('cart', [
            'user' => $user,
            'orderCartList' => $orderCartList,
            'orderPlacedList' => $orderPlacedList,
            'totalCartPlace' => isset($totalCartPlace) ? $totalCartPlace : null,
            'totalPlaced' => isset($totalPlaced) ? $totalPlaced : null,
            'SupCategorie' => $SupCategorie
        ]);
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
    public function placeOrder(Request $request)
    {
        $id = $request->input('customer');
        $user = $request->input('user');
        $orders = Order::where('customer_id', $id)->where('user_id', $user)->where('status','cart')->get();
        foreach ($orders as $order) {
            $order->status = 'placed';
            $order->save();
        }
        return redirect()->back()->with('success', 'Order placed successfully.');
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
        $cartItem = Order::find($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Order delete successfully.');
    }
    public function updateOrder(Request $request)
{
    $id = $request->input('orderId');
    $newQuantity = $request->input('quantity'); // Get the new quantity from the request
    $order = Order::find($id);

    if ($order && $newQuantity >= 1) { // Ensure the new quantity is at least 1
        $order->quantity = $newQuantity; // Update the quantity with the new value
        $order->save(); // Save the changes
        return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to update quantity']);
    }
}

}
