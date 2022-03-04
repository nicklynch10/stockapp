<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Stocks;
use App\Http\Livewire\Portfolio;
use App\Http\Livewire\Overview;
use App\Http\Livewire\Account;
use App\Http\Livewire\MarkNotification;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/addTicker',[HomeController::class,'addTicker'])->name('addticker');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Route::get('stock', Stocks::class,)->name('stock');
Route::middleware(['auth:sanctum', 'verified'])->get('portfolio', Stocks::class,)->name('portfolio');
Route::middleware(['auth:sanctum', 'verified'])->get('overview', Overview::class,)->name('overview');
Route::middleware(['auth:sanctum', 'verified'])->get('account', Account::class,)->name('account');
Route::middleware(['auth:sanctum', 'verified'])->get('notifications',[NotificationController::class,'show'])->name('notifications');

