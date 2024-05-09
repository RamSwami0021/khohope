<?php



namespace App\Http\Controllers;

use App\Models\Menu_Categories;
use App\Models\Menu_Items;
use App\Models\Order;
use App\Models\Order_History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Carbon\Carbon;

class HomeController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');
    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index(): View

    {
        $userId = Auth::id();
        $orders = Order::whereIn('status', ['placed', 'preparing', 'serve', 'complete'])->where('user_id',$userId)->get();


        $placedCount = $orders->where('status', 'placed')->count();
        $preparingCount = $orders->where('status', 'preparing')->count();
        $serveCount = $orders->where('status', 'serve')->count();
        $completeCount = $orders->where('status', 'complete')->count();


        $currentDate = Carbon::now();
        $startTime = $currentDate->copy()->startOfDay();
        $endTime = $currentDate->copy()->endOfDay();
        $todayOrders = Order_History::whereBetween('created_at', [$startTime, $endTime])->where('user_id',$userId)->count();

        $menu = Menu_Items::where('user_id', $userId)->count();
        $categories = Menu_Categories::where('user_id', $userId)->count();



        return view('home', compact('placedCount','preparingCount','serveCount','completeCount','todayOrders','menu','categories'));
    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function adminHome(): View

    {

        return view('adminHome');
    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function managerHome(): View

    {

        return view('managerHome');
    }
}
