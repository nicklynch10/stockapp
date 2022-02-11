<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Stocks;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('overview',function(){
   return view('overview'); })->name('overview');

Route::get('portfolio',function(){
   return view('portfolio'); })->name('portfolio');

Route::get('stock', Stocks::class,)->name('stock');

