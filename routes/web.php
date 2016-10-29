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

    // used to make ajax call, returns notebooks to view
    Route::get('/notebooks/index', 'NoteBookController@indexNotebooks')->name('notebooks.home.index');
    // displays all notebooks, call to notebooks.home.index is made from here
    Route::get('/notebooks', 'NoteBookController@home')->name('notebooks.home');

    // create notebook
    Route::post('/notebooks/create', 'NoteBookController@create')->name('notebooks.create');

    // used to make ajax call, returns notes for a notebook
    Route::get('/notebooks/{notebook}/index', 'NoteBookController@indexNotebook')->name('notebooks.show.index');
    // displays all notes for a given notebook, call to notebooks.show.index is made from here
    Route::get('/notebooks/{notebook}/show', 'NoteBookController@show')->name('notebooks.show');

    // manipulate notebook
    Route::get('/notebooks/{notebook}/edit', 'NoteBookController@edit')->name('notebooks.edit');
    Route::post('/notebooks/{notebook}/update', 'NoteBookController@update')->name('notebooks.update');
    Route::delete('/notebooks/{notebook}/delete', 'NoteBookController@destroy')->name('notebooks.destroy');

    // create and manipulate notes
    Route::post('/notebooks/{notebook}/note/create', 'NoteController@create')->name('note.create');
    Route::get('/notebooks/{notebook}/note/{note}/edit', 'NoteController@edit')->name('note.edit');
    Route::post('/notebooks/{notebook}/note/{note}/update', 'NoteController@update')->name('note.update');
    Route::delete('/notebooks/{notebook}/note/{note}/delete', 'NoteController@destroy')->name('note.destroy');

});
