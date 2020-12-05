<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Main_Controller;

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

Route::get('/', [Main_Controller::class, 'indexSports']);
Route::get('/leagues/{id}', [Main_Controller::class, 'indexLeagues']);
Route::get('/league/{id}', [Main_Controller::class, 'indexLeague']);
Route::get('/game/{id}', [Main_Controller::class, 'indexGame']);
Route::get('/gamebet/{id}', [Main_Controller::class, 'indexGameBet']);
Route::get('/team/{id}', [Main_Controller::class, 'indexTeam']);

Route::get('/admin/leagues/{id}', [Admin_Controller::class, 'indexLeagues']);
Route::get('/admin/league/{id}', [Admin_Controller::class, 'indexLeague']);
Route::get('/admin/game/{id}', [Admin_Controller::class, 'indexGame']);


Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\Admin_Controller::class, 'indexDashboard'])->name('home');
