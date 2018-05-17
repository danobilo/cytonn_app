<?php

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
Route::middleware('auth')->group(function() {
    Route::get('/', 'ContentsController@home')->name('home');
    Route::get('/tasks', 'TasksController@index')->name('tasks');
    Route::post('/tasks', 'TasksController@showSelectedTasks')->name('filter_tasks');
    Route::get('/tasks/new', 'TasksController@newTask')->name('new_task');
    Route::post('/tasks/new', 'TasksController@newTask')->name('create_task');
    Route::get('/tasks/{task_id}', 'TasksController@show')->name('show_task');
    Route::post('/tasks/{task_id}', 'TasksController@modify')->name('update_task');
    Route::get('/tasks/details/{task_id}', 'TasksController@taskDetails')->name('show_task_details');
    Route::get('/tasks/documents/upload/{task_id}', 'TasksController@upload')->name('upload');
    Route::post('/tasks/documents/upload/{task_id}', 'TasksController@upload')->name('upload');
    Route::get('/tasks/documents/download/{filename}', 'DocumentsController@download')->name('download');

    Route::get('/categories/new', 'CategoryController@newCategory')->name('new_category');
    Route::post('/categories/new', 'CategoryController@newCategory')->name('create_category');

    Route::get('/task/document/{task_id}/{user_id}/{name}', 'DocumentsController@addDocument')->name('add_document');
    Route::post('/task/comment/{task_id}/{user_id}', 'CommentsController@addComment')->name('add_comment');

    Route::get('export', 'TasksController@export')->name('export');

    Route::get('/taskboard', 'TasksController@showBoard')->name('show_board');
    Route::post('/taskboard', 'TasksController@showUserBoard')->name('show_user_board');
    
    Route::get('mail/send', 'MailController@send')->name('send_mail');
});


    
Auth::routes();


Route::get('/generate/password', function() {
    return bcrypt(123456789);
});
