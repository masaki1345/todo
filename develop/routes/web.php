<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/folders/create', 'App\Http\Controllers\FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'App\Http\Controllers\FolderController@create');

    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
        Route::get('/folders/{folder}/tasks/create', 'App\Http\Controllers\TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'App\Http\Controllers\TaskController@create');
    
        Route::get('/folders/{folder}/tasks/{task}/edit', 'App\Http\Controllers\TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', 'App\Http\Controllers\TaskController@edit');
    });
});

Route::group(['middleware' => 'auth'], function () {
    // 入力フォーム画面を返却するルート
    Route::get('/comment', 'App\Http\Controllers\CommentController@showForm')->name('comment');
    // 入力を受け付けるルート
    Route::post('/comment', 'App\Http\Controllers\CommentController@create');
    // 入力後にリダイレクトする完了画面のルート
    Route::get('/comment/thanks', 'App\Http\Controllers\CommentController@thanks')->name('comment.thanks');
});

Auth::routes();
