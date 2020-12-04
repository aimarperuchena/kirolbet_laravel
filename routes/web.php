<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\Sport_Controller;
use App\Http\Controllers\League_controller;
use App\Http\Controllers\Game_Controller;
use App\Http\Controllers\GameBet_Controller;
use App\Http\Controllers\Team_Controller;
use App\Http\Controllers\Admin_Controller;
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
Route::get('/game/{id}', [Game_Controller::class, 'getGame']);
Route::get('/gamebet/{id}', [GameBet_Controller::class, 'getGamebet']);
Route::get('/team/{id}', [Team_Controller::class, 'getTeam']);

Route::get('/admin/leagues/{id}', [Admin_Controller::class, 'indexLeagues']);
Route::get('/admin/league/{id}', [Admin_Controller::class, 'indexLeague']);
Route::get('/admin/game/{id}', [Admin_Controller::class, 'indexGame']);


Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\Admin_Controller::class, 'indexDashboard'])->name('home');
