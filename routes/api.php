<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/menu/store-menu', [MenuController::class, 'store'])->name('storeMenu');
Route::get('/menu/get-all-menu', [MenuController::class, 'get'])->name('getMenu');
Route::put('/menu/update-menu/{id}', [MenuController::class, 'update'])->name('updateMenu');
Route::delete('/menu/delete-menu/{id}', [MenuController::class, 'deleteMenu'])->name('deleteMenu');
