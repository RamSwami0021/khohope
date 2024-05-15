<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\Menu_CategoriesController;
use App\Http\Controllers\Menu_ItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupCategoriesController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebMenuController;
use App\Models\Menu_Categories;
use App\Models\SupCategorie;
use App\Models\User;

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/

Route::get('/admin/login', function () {
    return view('auth/login');
});
Route::get('/admin/register', function () {
    return view('auth/register');
});

Route::get('/{username?}', function ($username = null) {
    if ($username === null) {
        return view('welcome');
    } else {
        $user = User::where('username', $username)->first();
        $SupCategorie = SupCategorie::where('user_id', $user->id)->where('status','on')->get();
        return view('welcome', compact('user','SupCategorie'));
    }
});



Route::get('/menu/{username}/{id}', [WebMenuController::class, 'index'])->name('menu');
Route::post('/menu/{username}/{id}', [WebMenuController::class, 'index'])->name('updateFilter');
Route::post('addToCart', [WebMenuController::class, 'store'])->name('addToCart');
Route::post('customer', [WebMenuController::class, 'customer'])->name('customer');
Route::get('/cart/{username}', [CartController::class, 'index'])->name('cart');
Route::get('/cart/{username}', [CartController::class, 'index'])->name('cart');
Route::post('/placeOrder', [CartController::class, 'placeOrder'])->name('placeOrder');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/updateQuantity', [CartController::class, 'updateOrder'])->name('updateQuantity');

Route::get('/contact/data', function () {
    return view('contact');
});

Route::get('/about/data', function () {
    return view('about');
});



Auth::routes();



/*------------------------------------------

--------------------------------------------

All Normal Users Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/restaurants/home', [HomeController::class, 'index'])->name('restaurants.home');

    Route::get('restaurant/menu/add', [Menu_ItemsController::class, 'create'])->name('restaurant.menu.create');
    Route::post('restaurant/menu/store', [Menu_ItemsController::class, 'store'])->name('restaurant.menu.store');
    Route::get('restaurant/menu/list', [Menu_ItemsController::class, 'index'])->name('restaurant.menu.list');
    Route::delete('restaurant/menu/destroy/{id}', [Menu_ItemsController::class, 'destroy'])->name('restaurant.menu.destroy');
    Route::post('/restaurants/updateStatusMenu', [Menu_ItemsController::class, 'updateStatus'])->name('updateStatusMenu');
    Route::get('/menuedit/{id}', [Menu_ItemsController::class, 'edit'])->name('menuedit');
    Route::post('/menu-update/{id}', [Menu_ItemsController::class, 'update'])->name('restaurant.menu.update');



    Route::get('/restaurants/category/add', [Menu_CategoriesController::class, 'create'])->name('category.create');
    Route::post('/restaurants/category/store', [Menu_CategoriesController::class, 'store'])->name('category.store');
    Route::get('/restaurants/category/list', [Menu_CategoriesController::class, 'index'])->name('category.list');
    Route::delete('/restaurants/category/destroy/{id}', [Menu_CategoriesController::class, 'destroy'])->name('category.destroy');
    Route::post('/restaurants/updateStatus', [Menu_CategoriesController::class, 'updateStatus'])->name('updateStatus');

    Route::get('/restaurants/supcategory/add', [SupCategoriesController::class, 'create'])->name('supcategory.create');
    Route::post('/restaurants/supcategory/store', [SupCategoriesController::class, 'store'])->name('supcategory.store');
    Route::get('/restaurants/supcategory/list', [SupCategoriesController::class, 'index'])->name('supcategory.list');
    Route::delete('/restaurants/supcategory/destroy/{id}', [SupCategoriesController::class, 'destroy'])->name('supcategory.destroy');
    Route::post('/restaurants/supcategory/updateStatus', [SupCategoriesController::class, 'updateStatus'])->name('supcategory.updateStatus');

    Route::get('/restaurants/order', [OrderController::class, 'order'])->name('order');
    Route::get('/order/preparing', [OrderController::class, 'preparing'])->name('order.preparing');
    Route::get('/order/serve', [OrderController::class, 'server'])->name('order.server');
    Route::get('/order/complete', [OrderController::class, 'complete'])->name('order.complete');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
    Route::delete('/order/destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/storePrepraing/{order_id}', [OrderController::class, 'storePrepraing'])->name('order.storePrepraing');
    Route::get('/order/storeServe/{order_id}', [OrderController::class, 'storeServe'])->name('order.storeServe');
    Route::get('/order/storeComplete/{order_id}', [OrderController::class, 'storeComplete'])->name('order.storeComplete');
    Route::get('/order/storePaid/{order_id}', [OrderController::class, 'storePaid'])->name('order.storePaid');


    Route::post('/preparingAll', [OrderController::class, 'preparingAll'])->name('preparingAll');
    Route::post('/serveAll', [OrderController::class, 'serveAll'])->name('serveAll');
    Route::post('/completeAll', [OrderController::class, 'completeAll'])->name('completeAll');
    Route::post('/paidAll', [OrderController::class, 'paidAll'])->name('paidAll');

    Route::get('/restaurants/theme', [ThemeController::class, 'index'])->name('restaurants.theme');
    Route::get('/restaurants/theme/{id}', [ThemeController::class, 'update'])->name('theme.active');

    Route::get('/restaurants/profile', [ProfileController::class, 'index'])->name('restaurants.profile');
    Route::post('/restaurants/profile', [ProfileController::class, 'store'])->name('restaurants.profile');

    // Route::get('/storePrepraing/{order_id}', [HomeController::class, 'storePrepraing'])->name('manager.home');
    // Route::get('/storeServe/{order_id}', [HomeController::class, 'storeServe'])->name('manager.home');
    // Route::get('/storeComplete/{order_id}', [HomeController::class, 'storeComplete'])->name('manager.home');
    // Route::get('/storeBilled/{order_id}', [HomeController::class, 'storeBilled'])->name('manager.home');
    // Route::get('//{order_id}', [HomeController::class, 'storeBilled'])->name('manager.home');
    // Route::delete('/orderRemove/{id}', [HomeController::class, 'destroy'])->name('cart.destroy');
    // Route::post('/billed', [HomeController::class, 'billed'])->name('restaurant.billed');
    // Route::delete('/menudestroy/{id}', [HomeController::class, 'menudestroy'])->name('restaurant.menudestroy');
    // Route::delete('/catdestroy/{id}', [HomeController::class, 'catdestroy'])->name('restaurant.catdestroy');

});



/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {



    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

});



/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:manager'])->group(function () {



    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

});
