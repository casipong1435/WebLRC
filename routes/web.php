<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;
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

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/activity', 'activity')->name('activity');
    Route::get('/account', 'account')->name('account');
    Route::get('/{data?}', 'printReport')->name('printReport');
    
});

