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


//    User
    Route::get('users','UserController@index')->name('admin_users.index');
    Route::get('users/create', 'UserController@create')->name('admin_users.create');
    Route::post('users/store', 'UserController@store')->name('admin_users.store');
    Route::get('users/{user}/edit', 'UserController@edit')->name('admin_users.edit');
    Route::post('users/{user}/update', 'UserController@update')->name('admin_users.update');




//    announcement

    Route::get('/announcements/create','AnnouncementController@create')->name('admin_announcement.create');
    Route::post('/announcements/store','AnnouncementController@store')->name('admin_announcement.store');
    Route::post('/announcements/{announcement}/update','AnnouncementController@update')->name('admin_announcement.update');
    Route::get('/announcements/{announcement}/edit','AnnouncementController@edit')->name('admin_announcement.edit');
    Route::get('/announcements','AnnouncementController@index')->name('admin_announcement.index');

//    info
    Route::get('/info/create','InfoController@create')->name('admin_info.create');
    Route::post('/info/store','InfoController@store')->name('admin_info.store');
    Route::post('/info/{announcement}/update','InfoController@update')->name('admin_info.update');
    Route::get('/info/{announcement}/edit','InfoController@edit')->name('admin_info.edit');
    Route::get('/info','InfoController@index')->name('admin_info.index');




// vote
    Route::get('/votes/create','VoteController@create')->name('admin_vote.create');
    Route::post('/votes/store','VoteController@store')->name('admin_vote.store');
    Route::post('/votes/{vote}/update','VoteController@update')->name('admin_vote.update');
    Route::post('/votes/{vote}/submitVote','VoteController@submitVote')->name('admin_vote.submitVote');

    Route::get('/votes/{vote}/edit','VoteController@edit')->name('admin_vote.edit');
    Route::get('/votes/{vote}/vote','VoteController@vote')->name('admin_vote.vote');
    Route::get('/votes/{vote}/result','VoteController@result')->name('admin_vote.result');

    Route::get('/votes','VoteController@index')->name('admin_vote.index');


});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    if(Auth::check()) {
        if(Auth::user()->type == 1)
        return redirect('/admin/');
    }
    else {
        return view('auth.login');
    }
});


