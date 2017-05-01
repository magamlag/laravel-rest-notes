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

Route::group(['prefix'  =>  '/github','namespace' =>  'Github'],function(){
    Route::get('/',[
        'as'    =>  'github.index',
        'uses'  =>  'IndexController@index'
    ]);

    Route::post('/user_area',[
        'as'    =>  'github.postlogin',
        'uses'  =>  'IndexController@checkUser'
    ]);

    Route::get('/user_area',[
        'as'    =>  'github.user_area',
        'uses'  =>  'UserAreaController@area'
    ]);

    Route::get('/user_area/repos',[
        'as'    =>  'github.user_area.repos',
        'uses'  =>  'UserAreaController@repositories'
    ]);

    Route::get('/user_area/issues',[
        'as'    =>  'github.user_area.issues',
        'uses'  =>  'UserAreaController@issues'
    ]);
});
