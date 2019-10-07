<?php

Route::middleware(['web'])->namespace('Admin')->prefix('admin')->group(function() {
    Route::resource('news', 'NewsController');
    Route::resource('rubric', 'RubricController');
    Route::resource('users', 'UsersController');
    Route::resource('position', 'PositionController');
    Route::resource('menu', 'MenuController');
    Route::resource('pages', 'PageController');
    Route::resource('role', 'RoleController');
    Route::resource('archive', 'ArchiveController');
    Route::resource('banner', 'BannerController');
    Route::resource('slider', 'SliderController');
    Route::resource('subscription', 'SubscriptionController');
    Route::get('/', function () {
        return view('admin.index');
    });
});

Route::middleware(['web'])->group(function() {
    Route::get('media/{file_name}', 'MediaController@getImage')->where('file_name', '.*');
    Route::get('media_avatar/{file_name}', 'MediaController@getAvatar')->where('file_name', '.*');
    Route::get('media_doc/{file_name}', 'MediaController@getFile')->where('file_name', '.*');
    Route::get('media_content/{file_name}', 'MediaController@getContentImage')->where('file_name', '.*');
    Route::post('content_image', 'MediaController@storeContentImage');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
