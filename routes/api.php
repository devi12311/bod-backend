<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('excel','App\Http\Controllers\BillController@import');
Route::get('bill/{id}','App\Http\Controllers\BillController@getBillsById');
Route::get('bills/{id}','App\Http\Controllers\BillController@getBillsByUser');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
