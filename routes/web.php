<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GoogleController;
use App\Http\Livewire\UiChange;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Livewire\Stocks;
use App\Http\Livewire\Portfolio;
use App\Http\Livewire\Overview;
use App\Http\Livewire\Account;
use App\Http\Livewire\MarkNotification;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SecInfoController;
use App\Http\Controllers\SecCompareController;

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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/addTicker', [HomeController::class,'addTicker'])->name('addticker');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('help', function () { return view('support.help'); })->name('help');
Route::get('portfolio', Stocks::class, )->middleware(['auth:sanctum', 'verified'])->name('portfolio');
Route::get('overview', Overview::class, )->middleware(['auth:sanctum', 'verified'])->name('overview');
Route::get('account', Account::class, )->middleware(['auth:sanctum', 'verified'])->name('account');
Route::get('uichange', UiChange::class, )->middleware(['auth:sanctum', 'verified'])->name('uichange');
Route::get('notifications', [NotificationController::class,'show'])->middleware(['auth:sanctum', 'verified'])->name('notifications');
Route::get('cron', [DeveloperController::class, 'cron'])->name('cron');


// ** Migration Routes ** //
Route::get('/migrate', function(){
    Artisan::call('migrate');
    dd('migrated!');
});

Route::get('schedule-run',function (){
   Artisan::call('schedule:run');
   dd('Schedule Run');
});

// ** run-seeder/StockSeeder ** //
Route::get('run-seeder/{class}',function($class){
 Artisan::call("db:seed",array('--class'=>$class));
 dd('Run Seeder');
});


// ** NL Routes ** //
Route::get('compare', [SecInfoController::class, 'launch'])->name('compare');
Route::get('check-for-comps', [SecInfoController::class, 'view'])->name('correlation-check');
