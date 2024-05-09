<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\CollegeStudentController;
Route::post('/college/students', [CollegeStudentController::class, 'create']);
Route::get('/college/students/email/{email}', [CollegeStudentController::class, 'getByEmail']);
Route::get('/college/students/phone/{phoneNumber}', [CollegeStudentController::class, 'getByPhoneNumber']);
Route::get('/college/students', [CollegeStudentController::class, 'getAll']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
