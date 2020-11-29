<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\Sport_Controller;
use App\Http\Controllers\League_controller;
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

Route::get('/', [Sport_Controller::class, 'getSports']);
Route::get('/leagues/{id}', [League_controller::class, 'getLeagues']);
Route::get('/league/{id}', [League_controller::class, 'getLeague']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
