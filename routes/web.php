<?php

use App\Http\Controllers\LamaranController;
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

Route::get('/', function () {
    return redirect();
});

Route::resource('lamaran', '\App\Http\Controllers\LamaranController')
    ->except('store', 'create', 'show', 'edit', 'destory', 'update');
