<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\categoryController;
use App\Http\Controllers\Api\ProductController;
use GuzzleHttp\Psr7\Message;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// all post request

Route::post('/addcategory', [CategoryController::class, 'addcategory']
);

Route::post('/addproduct', [ProductController::class,'addproducts']
);

Route::post('/productupdate', [ProductController::class,'update']
);

// all get request
Route::get('/showcategory', [CategoryController::class,'showcategory']
);


Route::get('/productdata', [ProductController::class,'showproduct']
);


// Delete

Route::delete('/productdelete/{id}' , [ProductController::class,'productdelete']);


Route::delete('/categorydelete/{id}' , [CategoryController::class,'categorydelete']);


// put

Route::put('/productshow/{id}' , [ProductController::class,'productedit']);