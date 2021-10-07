<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('redirects', [HomeController::class, 'redirects']);

Route::get('/users', [AdminController::class, 'users']);

Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser']);

Route::get('/FoodMenu', [AdminController::class, 'FoodMenu']);

Route::post('/uploadfood',[AdminController::class, 'uploadfood']); 

Route::get('/deletemenu/{id}',[AdminController::class, 'deletemenu']);

Route::get('/updatemenu/{id}',[AdminController::class, 'updatemenu']);

Route::post('/update/{id}',[AdminController::class, 'update']); 

Route::post('/reservations',[AdminController::class, 'reservations']); 

Route::get('/viewreservation',[AdminController::class, 'viewreservation']); 

Route::get('/viewchefs',[AdminController::class, 'viewchefs']); 

Route::Post('/uploadchefs',[AdminController::class, 'uploadchefs']);

Route::get('/deletechef/{id}',[AdminController::class, 'deletechef']); 

Route::get('/updatechef/{id}',[AdminController::class, 'updatechef']); 

Route::Post('/updatechefdb/{id}',[AdminController::class, 'updatechefdb']);

Route::Post('/addcart/{id}',[HomeController::class, 'addcart']);

Route::get('/showcart/{id}',[HomeController::class, 'showcart']); 

Route::get('/remove/{id}',[HomeController::class, 'remove']); 

Route::Post('/makeorder',[HomeController::class, 'makeorder']);

Route::get('/vieworders',[AdminController::class, 'vieworders']); 

Route::get('/search',[AdminController::class, 'search']);










Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
