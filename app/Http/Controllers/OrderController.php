<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\History;
use App\Models\Order_History;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function order()
    {
        $userId = Auth::id();

        $list = Order::where('user_id', $userId)->where('status', 'placed')->latest()->get();
        $customersWithOrders = [];

        foreach ($list as $order) {
            $customer = Customer::find($order->customer_id);

            if ($customer) {
                if (!isset($customersWithOrders[$customer->id])) {
                    $customersWithOrders[$customer->id] = [
                        'customer' => $customer,
                        'orders' => []
                    ];
                }
                $customersWithOrders[$customer->id]['orders'][] = $order;
            }
        }

        return view('admin/order', compact('customersWithOrders'));
    }
    public function preparing()
    {
        $userId = Auth::id();

        $list = Order::where('user_id', $userId)->where('status', 'preparing')->latest()->get();
        $customersWithOrders = [];

        foreach ($list as $order) {
            $customer = Customer::find($order->customer_id);

            if ($customer) {
                if (!isset($customersWithOrders[$customer->id])) {
                    $customersWithOrders[$customer->id] = [
                        'customer' => $customer,
                        'orders' => []
                    ];
                }
                $customersWithOrders[$customer->id]['orders'][] = $order;
            }
        }

        return view('admin/orderpreparing', compact('customersWithOrders'));
    }
    public function server()
    {
        $userId = Auth::id();

        $list = Order::where('user_id', $userId)->where('status', 'serve')->latest()->get();
        $customersWithOrders = [];

        foreach ($list as $order) {
            $customer = Customer::find($order->customer_id);

            if ($customer) {
                if (!isset($customersWithOrders[$customer->id])) {
                    $customersWithOrders[$customer->id] = [
                        'customer' => $customer,
                        'orders' => []
                    ];
                }
                $customersWithOrders[$customer->id]['orders'][] = $order;
            }
        }
        return view('admin/orderServe', compact('customersWithOrders'));
    }
    public function complete()
    {
        $userId = Auth::id();

        $list = Order::where('user_id', $userId)->where('status', 'complete')->latest()->get();
        $customersWithOrders = [];

        foreach ($list as $order) {
            $customer = Customer::find($order->customer_id);

            if ($customer) {
                if (!isset($customersWithOrders[$customer->id])) {
                    $customersWithOrders[$customer->id] = [
                        'customer' => $customer,
                        'orders' => []
                    ];
                }
                $customersWithOrders[$customer->id]['orders'][] = $order;
            }
        }
        return view('admin/ordercomplete', compact('customersWithOrders'));
    }
    public function history()
    {
        $userId = Auth::id();
        $list = Order_History::where('user_id', $userId)->latest()->get();
        $customersWithOrders = [];
        foreach ($list as $order) {
            $customer = Customer::find($order->customer_id);

            if ($customer) {
                if (!isset($customersWithOrders[$customer->id])) {
                    $customersWithOrders[$customer->id] = [
                        'customer' => $customer,
                        'orders' => []
                    ];
                }
                $customersWithOrders[$customer->id]['orders'][] = $order;
            }
        }
        return view('admin/orderhistory',compact('customersWithOrders'));
    }

    public function index()
    {
        //
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
    public function storePrepraing($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->status = 'preparing';
            $order->save();
        }
        return redirect()->back()->with('success', 'Order prepraing successfully.');
    }
    public function storeServe($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->status = 'serve';
            $order->save();
        }
        return redirect()->back()->with('success', 'Order Serve successfully.');
    }
    public function storeComplete($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->status = 'complete';
            $order->save();
        }
        return redirect()->back()->with('success', 'Order complete successfully.');
    }
    public function storePaid($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $this->moveOrderToHistory($order);
            $order->delete();
            return redirect()->back()->with('success', 'Order completed successfully.');
        }
        return redirect()->back()->with('error', 'Order not found.');
    }
    public function paidAll(Request $request)
    {
        $customer = $request->customer;
        $orders = Order::where('customer_id', $customer)->where('status','complete')->get();

        foreach ($orders as $order) {
            $this->moveOrderToHistory($order);
            $order->delete();
        }

        return redirect()->back()->with('success', 'All orders placed successfully.');
    }


    private function moveOrderToHistory($order)
    {
        Order_History::create([
            'customer_id' => $order->customer_id,
            'status' => 'paid',
            'menu_id' => $order->menu_id,
            'customer_id' => $order->customer_id,
            'quantity' => $order->quantity,
            'user_id' => $order->user_id,
            'price' => $order->price,
        ]);
    }

    public function preparingAll(Request $request)
    {
        $customer = $request->customer;
        $orders = Order::where('customer_id', $customer)->where('status','placed')->get();

        foreach ($orders as $order) {
            $order->status = 'preparing';
            $order->save();
        }
        return redirect()->back()->with('success', 'Order placed successfully.');
    }
    public function serveAll(Request $request)
    {
        $customer = $request->customer;
        $orders = Order::where('customer_id', $customer)->where('status','preparing')->get();

        foreach ($orders as $order) {
            $order->status = 'serve';
            $order->save();
        }
        return redirect()->back()->with('success', 'Order placed successfully.');
    }
    public function completeAll(Request $request)
    {
        $customer = $request->customer;
        $orders = Order::where('customer_id', $customer)->where('status','serve')->get();

        foreach ($orders as $order) {
            $order->status = 'complete';
            $order->save();
        }
        return redirect()->back()->with('success', 'Order placed successfully.');
    }
}
