<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('contacts', [ContactController::class, 'contacts']);
Route::post('save_contact', [ContactController::class, 'saveContact']);
Route::get('get_contact/{id}', [ContactController::class, 'getContact']);
Route::post('update_contact/{id}', [ContactController::class, 'updateContact']);
Route::delete('delete_contact/{id}', [ContactController::class, 'deleteContact']);




Route::group(['namespace' => 'Api'], function(){
    Route::post('save_user', [UserController::class, 'saveUser']);
    Route::post('login', [AuthController::class, 'login']);    
    Route::post('checkToken', [AuthController::class, 'checkToken']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('admin', [AdminController::class, 'index']);

    //product
    Route::get('products', [ProductController::class, 'products']);
    Route::post('save_product', [ProductController::class, 'saveProduct']);
    Route::get('get_product/{id}', [ProductController::class, 'getProduct']);
    Route::post('update_product/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('delete_product/{id}', [ProductController::class, 'deleteProduct']);

});