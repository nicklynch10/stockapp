<?php

use App\Http\Controllers\AnalyzeCompareController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FactordetailController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SubmitPlaidDataController;
use App\Http\Controllers\UserInvitesController;
use App\Http\Controllers\RegisterController;
use App\Http\Livewire\Optimize;
use Illuminate\Support\Facades\Mail;
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
use App\Http\Controllers\FactorController;
use App\Mail\TestEmail;

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
    return view('home.home');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/addTicker', [HomeController::class,'addTicker'])->name('addticker');// Add ticker in database
Route::middleware(['auth:sanctum', 'verified'])->get('/addMutualFunds', [HomeController::class,'addMutualFunds'])->name('addmutualfunds');// Add mutual funds in database
Route::middleware(['auth:sanctum', 'verified'])->get('/addCryptoCurrency', [HomeController::class,'addCryptoCurrency'])->name('addcryptocurrency');// Add mutual funds in database



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('help', function () {
    return view('support.help');
})->name('help');
//Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'destroy'])
//    ->name('logout');

Route::get('portfolio', Stocks::class, )->middleware(['auth:sanctum', 'verified'])->name('portfolio');
Route::get('overview', Overview::class, )->middleware(['auth:sanctum', 'verified'])->name('overview');
Route::get('optimize', Optimize::class, )->middleware(['auth:sanctum', 'verified'])->name('optimize');
Route::get('account', Account::class, )->middleware(['auth:sanctum', 'verified'])->name('account');
Route::get('register', [RegisterController::class, 'register'])->name('register');


Route::middleware(['auth:sanctum', 'verified'])->get('notifications', [NotificationController::class,'show'])->name('notifications');
Route::get('cron', [DeveloperController::class, 'cron'])->name('cron');
Route::middleware(['auth:sanctum', 'verified'])->post('submitPlaidData', [SubmitPlaidDataController::class,'submitPlaidData'])->name('submitPlaidData');
Route::middleware(['auth:sanctum', 'verified'])->get('/user/manage-invites', [UserInvitesController::class,'manageInvites'])->name('user.manage-invites');
Route::middleware(['auth:sanctum','verified'])->get('user/manage/users', [UserInvitesController::class, 'manage_users'])->name('user.manage.users');


// ** Migration Routes ** //
Route::get('/migrate', function () {
    Artisan::call('migrate');
    dd('migrated!');
});

Route::get('schedule-run', function () {
    Artisan::call('schedule:run');
    dd('Schedule Run');
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    dd('Storage Link');
});

// ** run-seeder/StockSeeder ** //
Route::get('run-seeder/{class}', function ($class) {
    Artisan::call("db:seed", array('--class'=>$class));
    dd('Run Seeder');
});


// ** NL Routes ** //
Route::get('compare', [SecInfoController::class, 'launch'])->name('compare');
Route::get('check-for-comps', [SecInfoController::class, 'view'])->name('correlation-check');
//Route::get('factors', [FactorController::class, 'factors'])->name('factors');
Route::get('analyze-compare', [AnalyzeCompareController::class, 'factors'])->name('analyze-compare');
Route::any('analyze', [FactordetailController::class, 'view2'])->name('analyze');
Route::any('analyzeticker/{ticker}', [FactordetailController::class, 'analyzeticker'])->name('analyzeticker');


// new home routes //
Route::get('/learn-more', function () {
    return view('home.learn-more');
});
Route::get('/how-it-works', function () {
    return view('home.how-it-works');
});
// Route::get('/analytics', function () {
//     return view('home.analytics');
// });
Route::get('/home', function () {
    return view('home.home');
});


Route::any('test2', [FactorController::class, 'factor_compare'])->name('factor_compare');


Route::get('/test-email', function () {
    Mail::to('nick@taxghost.com')->send(new TestEmail());
});

//Route::get('analyze2', [FactordetailController::class, 'view2'])->name('analyze2');
