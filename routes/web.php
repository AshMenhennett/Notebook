<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/notebooks', 'NoteBookController@index')->name('notebooks.index');
    Route::post('/notebooks/create', 'NoteBookController@create')->name('notebooks.create');
    Route::get('/notebooks/{notebook}/show', 'NoteBookController@show')->name('notebooks.show');
    Route::get('/notebooks/{notebook}/edit', 'NoteBookController@edit')->name('notebooks.edit');
    Route::post('/notebooks/{notebook}/update', 'NoteBookController@update')->name('notebooks.update');
    Route::delete('/notebooks/{notebook}', 'NoteBookController@destroy')->name('notebooks.destroy');

    Route::post('/notebooks/{notebook}/note/create', 'NoteController@create')->name('note.create');
    Route::get('/notebooks/{notebook}/note/{note}/edit', 'NoteController@edit')->name('note.edit');
    Route::post('/notebooks/{notebook}/note/{note}/update', 'NoteController@update')->name('note.update');
    Route::delete('/notebooks/{notebook}/note/{note}', 'NoteController@destroy')->name('note.destroy');

});
