<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


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

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::get('getproducts/{id}', [ProductController::class, 'getProductsPerCategory']);
Route::post('addproducts/{id}', [ProductController::class, 'addProduct']);

Route::get('product/search/{name}', [ProductController::class, 'searchProduct']);
Route::get('category/search/{name}', [CategoryController::class, 'searchCategory']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
