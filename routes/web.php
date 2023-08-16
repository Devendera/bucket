<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreventBackHistory;
use App\Http\Controllers\DataController;
use App\Http\Controllers\BallController;
use App\Http\Controllers\BucketSuggestionController;
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


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get("/", function(){
    return view("welcome");
 });

//Route::get('/', [BucketController::class, 'index']);


Route::middleware('prevent-back-history')->group(function () {

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'signOut'])->name('logout');

Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');

Route::get('/bucket', [BucketController::class, 'index'])->name('bucket.index');
Route::get('/bucket/create', [BucketController::class, 'create'])->name('bucket.create');
Route::post('/bucket/store', [BucketController::class, 'store'])->name('bucket.store');

Route::get('/bucket/edit/{id}', [BucketController::class, 'edit'])->name('bucket.edit');
Route::post('/bucket/update', [BucketController::class, 'update'])->name('bucket.update');

Route::get('/bucket/delete/{id}', [BucketController::class, 'delete'])->name('delete');
Route::post('/deleteMultiple', [BucketController::class, 'delete_multiple'])->name('deleteMultiple');

Route::get('/ball', [BallController::class, 'index'])->name('ball.index');
Route::get('/ball/create', [BallController::class, 'create'])->name('ball.create');
Route::post('/ball/store', [BallController::class, 'store'])->name('ball.store');

Route::get('/ball/edit/{id}', [BallController::class, 'edit'])->name('ball.edit');
Route::post('/ball/update', [BallController::class, 'update'])->name('ball.update');

Route::get('/ball/delete/{id}', [BallController::class, 'delete'])->name('delete');
Route::post('/deleteMultiple', [BallController::class, 'delete_multiple'])->name('deleteMultiple');

Route::get('/suggestion', [BucketSuggestionController::class, 'index'])->name('suggestion.index');
Route::post('/suggestion', [BucketSuggestionController::class, 'postSuggestion'])->name('suggestion.post');
});
