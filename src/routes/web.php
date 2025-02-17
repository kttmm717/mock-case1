<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Requests\EmailVerificationRequest;

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
//新規登録ルート
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/email/verify', function() {
    return view('auth.verify-email');
});
Route::post('/email/verify', function() { //認証メール再送ボタン押された時のルート
    session()->get('unauthentication_user')->sendEmailVerificationNotification();
    session()->put('resent', true);
    return back()->with('message', '認証メールを送りました');
});

//メール認証されると自動で下記ルートへ
Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
    $request->fulfill();
    session()->forget('unauthentication_user');
    return redirect('/mypage/profile');
});