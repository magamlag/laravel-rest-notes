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

Route::get('/section/1/collection',[
    'uses'  =>  'SectionOneCollectionController@index',
    'as'    =>  'section.one.collection'
]);

Route::group(['prefix'  =>  '/github','namespace' =>  'Github'],function(){
    Route::get('/',[
        'as'    =>  'github.index',
        'uses'  =>  'IndexController@index'
    ]);

    Route::get('/login', [
       'as' => 'github.login',
        'uses'=> 'IndexController@logIn'
    ]);

    Route::post('/',[
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

    Route::get('/login_out',[
        'as'    => 'github.login_out',
        'uses'  => 'IndexController@loginOut'
    ]);

});

Route::get('/test',function () {
    return collect([1,2,3,4,5,6,6,44334,33322,11,3])->mean();
});

Auth::routes();

Route::get('/home', 'HomeController@index');
