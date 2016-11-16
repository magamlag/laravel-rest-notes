<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/notes', 'NotesController');

Route::post('/notes/{id}/add_tag',[
    'as'    =>  'api.notes.add_tag',
    'uses'  =>  'NotesController@addTag'
]);

Route::delete('/notes/{note_id}/remove_tag/{tag_id}',[
    'as'    =>  'api.notes.remove_tag',
    'uses'  =>  'NotesController@removeTag'
]);
