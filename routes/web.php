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

Route::middleware(['auth'])->group(function(){
    Route::controller(TicketController::class)->group(function(){
        Route::get('/tickets', 'index');
        Route::get('/tickets/create', 'create');
        Route::post('/tickets', 'store');
    });

    Route::get('/lotto/rolling', RollEventStarter::class);
    Route::post('/lotto/rolling', RollController::class);
    Route::post('/lotto/results', ResultsController::class);
});



Route::get('/records/leaderboards', [RecordsController::class, 'showLeaderboards']);


// protect this invalid routes
Route::get('/lotto/results', function(){
    return back();
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// temporary home
Route::get('/home', [TicketController::class, 'index']);