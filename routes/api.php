<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);  //READ *

//POST
Route::post('create/category',[RouteController::class,'createCategroy']); //CREADE
Route::post('create/contact',[RouteController::class,'createContact']);

Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']); //DELETE

Route::get('category/details/{id}',[RouteController::class,'categoryDetails']); //READ

Route::post('category/update',[RouteController::class,'updateCategory']); //UPDATE


/**
 * product list
 * localhost:8000/api/product/list (get)
 *
 * category list
 * localhost:8000/api/category/list (get)
 *
 * create category
 * localhost:8000/api/create/category (post)
 * body{
 *   name : ''
 * }
 *
 * localhost:8000/api/category/delete/id (get)
 *
 * localhost:8000/api/category/details/id (get)
 *
 * localhost:8000/api/category/update (post)
 * body{
 *  category_id : '', name : ''
 * }
 *
 */
