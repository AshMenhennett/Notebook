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

Route::group(['prefix' => 'notebooks', 'middleware' => ['auth']], function() {

    // used to make ajax call, returns notebooks to view
    Route::get('/index', 'NoteBookController@indexNotebooks')->name('notebooks.home.index');
    // displays all notebooks, call to notebooks.home.index is made from here
    Route::get('/', 'NoteBookController@home')->name('notebooks.home');

    // create notebook
    Route::post('/create', 'NoteBookController@create')->name('notebook.create');

    // used to make ajax call, returns notes for a notebook
    Route::get('/{notebook}/index', 'NoteBookController@indexNotebook')->name('notebook.show.index');
    // displays all notes for a given notebook, call to notebooks.show.index is made from here
    Route::get('/{notebook}/show', 'NoteBookController@show')->name('notebook.show');

    // manipulate notebook
    Route::get('/{notebook}/edit', 'NoteBookController@edit')->name('notebook.edit');
    Route::post('/{notebook}/update', 'NoteBookController@update')->name('notebook.update');
    Route::delete('/{notebook}/delete', 'NoteBookController@destroy')->name('notebook.destroy');

    // create and manipulate notes
    Route::post('/{notebook}/notes/create', 'NoteController@create')->name('note.create');
    Route::get('/{notebook}/notes/{note}/edit', 'NoteController@edit')->name('note.edit');
    Route::post('/{notebook}/notes/{note}/update', 'NoteController@update')->name('note.update');
    Route::delete('/{notebook}/notes/{note}/delete', 'NoteController@destroy')->name('note.destroy');

});
