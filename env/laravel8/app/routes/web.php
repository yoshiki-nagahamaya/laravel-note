<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthController;

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

Route::group(['middleware' => ['guest']], function(){
    //新規登録
    Route::get('/register', [AuthController::class,'showRegister'])->name('register.show');
    //登録処理
    Route::post('/register/register',[AuthController::class, 'store'])->name('register');
    //ログインフォーム表示
    Route::get('/', [AuthController::class,'showLogin'])->name('login.show');
    //ログイン処理
    Route::post('/login', [AuthController::class,'login'])->name('login');
});

Route::group(['middleware' => ['auth']], function(){
    //ホーム画面
    Route::get('/home',function(){
        return view('home');
    })->name('home');
    //create画面
    Route::get('/create',HomeController::class,'')
    //ログアウト
    Route::post('logout',[AuthController::class,'logout'])->name('logout');
});
