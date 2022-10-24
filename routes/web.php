<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Lotto\RollEventStarter;
use App\Http\Controllers\Lotto\RollController;
use App\Http\Controllers\Lotto\ResultsController;
use App\Http\Controllers\RecordsController;

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
    return view('welcome');
});

Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/create', [TicketController::class, 'create']);
Route::post('/tickets', [TicketController::class, 'store']);

Route::get('/lotto/rolling', RollEventStarter::class);
Route::post('/lotto/rolling', RollController::class);
Route::post('/lotto/results', ResultsController::class);

Route::get('/records/leaderboards', [RecordsController::class, 'showLeaderboards']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');