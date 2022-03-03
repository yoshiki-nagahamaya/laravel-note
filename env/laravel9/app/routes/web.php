<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

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

Route::controller(MemberController::class)->prefix('member')->group(function () {
    Route::get('index','index')->name('member.index');
    Route::get('create','create')->name('member.create');
    Route::post('store','store')->name('member.store');
    Route::get('show/{id}','show')->name('member.show');
    Route::get('edit/{id}','edit')->name('member.edit');
    Route::post('update/{id}','update')->name('member.update');
    Route::post('destroy/{id}','destroy')->name('member.destroy');
    Route::get('search','search')->name('member.search');
});

