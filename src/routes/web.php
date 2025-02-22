<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Requests\EmailVerificationRequest;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;

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
    return back()->with('message', '認証メールを送りました');
});

//メール認証されると自動で下記ルートへ
Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
    $request->fulfill();
    session()->forget('unauthentication_user');
    return redirect('/mypage/profile');
})->name('verification.verify');


Route::get('/', [ItemController::class, 'index'])->name('items');
Route::get('/item/{item_id}', [ItemController::class, 'detail']);

Route::middleware('auth')->group(function() {
    Route::get('/mypage', [UserController::class, 'mypage']);
    Route::get('/mypage/profile', [UserController::class,'profileView']);
    Route::post('/mypage/profile',[UserController::class, 'profileCreate']);
    Route::post('/delete-like/{item_id}', [LikeController::class, 'delete']);
    Route::post('/create-like/{item_id}', [LikeController::class, 'create']);
    Route::post('/comment/{item_id}', [CommentController::class, 'create']);
    Route::get('/sell', [ItemController::class, 'sellView']);
    Route::post('/sell', [ItemController::class, 'sellCreate']);
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'index']);
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'purchase']);
    Route::get('/purchase/{item_id}/success', [PurchaseController::class, 'success']);
});
