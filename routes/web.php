<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Stocks;
use App\Http\Livewire\Portfolio;
use App\Http\Livewire\Overview;
use App\Http\Livewire\Account;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Route::get('stock', Stocks::class,)->name('stock');
Route::get('portfolio', Stocks::class,)->name('portfolio');
Route::get('overview', Overview::class,)->name('overview');
Route::get('account', Account::class,)->name('account');

