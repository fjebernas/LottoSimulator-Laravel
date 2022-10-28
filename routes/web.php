<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Lotto\RollEventStarter;
use App\Http\Controllers\Lotto\RollController;
use App\Http\Controllers\Lotto\ResultsController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\MenuController;
use App\Http\Middleware\EnsureLottoTypeIsDefined;
use App\Http\Controllers\LottoTypeController;

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

Route::middleware(['forgetLottoSession'])->group(function(){
    Auth::routes();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', [MenuController::class, 'menu']);

    Route::controller(RecordsController::class)->group(function(){
        Route::get('/records/leaderboards', 'showLeaderboards');
    });
    
    Route::middleware(['auth'])->group(function(){
        Route::controller(LottoTypeController::class)->group(function(){
            Route::get('/lottotype/create', 'create');
            Route::post('/lottotype', 'store');
        });

        Route::controller(MenuController::class)->group(function(){
            Route::get('/menu', 'menu');
            Route::get('/menu/set', 'setSessionDataAndRedirect');
        });
    
        Route::withoutMiddleware(['forgetLottoSession'])->group(function(){
            Route::middleware(['ensureLottoSessionIsSet'])->group(function(){
                Route::controller(TicketController::class)->group(function(){
                    Route::get('/tickets', 'index');
                    Route::get('/tickets/create', 'create');
                    Route::post('/tickets', 'store');
                });
            });
        
            Route::get('/lotto/rolling', RollEventStarter::class);
            Route::post('/lotto/rolling', RollController::class);
            Route::post('/lotto/results', ResultsController::class);
        });
    });
    
    // protect this invalid routes
    Route::get('/lotto/results', function(){
        return back();
    });
});