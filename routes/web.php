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

Route::group(['prefix' => 'admin', 'middleware' => ['auth'] , 'namespace' => 'Admin'], function(){
    Route::get('/','DashboardController@index')->name('admin_dashboard.index');



//    announcement

    Route::get('/announcements/create','AnnouncementController@create')->name('admin_announcement.create');
    Route::post('/announcements/store','AnnouncementController@store')->name('admin_announcement.store');
    Route::post('/announcements/{announcement}/update','AnnouncementController@update')->name('admin_announcement.update');
    Route::get('/announcements/{announcement}/edit','AnnouncementController@edit')->name('admin_announcement.edit');
    Route::get('/announcements','AnnouncementController@index')->name('admin_announcement.index');


// vote
    Route::get('/votes/create','VoteController@create')->name('admin_vote.create');
    Route::post('/votes/store','VoteController@store')->name('admin_vote.store');
    Route::post('/votes/{vote}/update','VoteController@update')->name('admin_vote.update');
    Route::get('/votes/{vote}/edit','VoteController@edit')->name('admin_vote.edit');
    Route::get('/votes','VoteController@index')->name('admin_vote.index');


});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


