<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FirebaseController;

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

Route::get('send-bulk-mail', [MailController::class, 'sendBulkMail'])->name('send-bulk-mail');
Route::get('post', [MailController::class, 'post'])->name('post');
Route::post('create-post', [MailController::class, 'createPost'])->name('create-post');


//auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//livewire
Route::view('employees', 'layouts.master')->middleware('auth:web');

//firebase
Route::patch('/fcm-token', [FirebaseController::class, 'updateToken'])->name('updateToken');
Route::post('/send-notification',[FirebaseController::class,'notification'])->name('notification');
