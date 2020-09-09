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

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin_dashboard.index');


//    User
    Route::get('users', 'UserController@index')->name('admin_users.index');
    Route::get('users/create', 'UserController@create')->name('admin_users.create');
    Route::post('users/store', 'UserController@store')->name('admin_users.store');
    Route::get('users/{user}/edit', 'UserController@edit')->name('admin_users.edit');
    Route::post('users/{user}/update', 'UserController@update')->name('admin_users.update');
    Route::post('users/import', 'UserController@import')->name('admin_users.import');


//    company
    Route::get('companies', 'CompanyController@index')->name('admin_company.index');
    Route::get('companies/create', 'CompanyController@create')->name('admin_company.create');
    Route::post('companies/store', 'CompanyController@store')->name('admin_company.store');
    Route::get('companies/{company}/edit', 'CompanyController@edit')->name('admin_company.edit');
    Route::post('companies/{company}/update', 'CompanyController@update')->name('admin_company.update');
    Route::post('companies/import', 'CompanyController@import')->name('admin_company.import');


//    announcement

    Route::get('/announcements/create', 'AnnouncementController@create')->name('admin_announcement.create');
    Route::post('/announcements/store', 'AnnouncementController@store')->name('admin_announcement.store');
    Route::post('/announcements/{announcement}/update', 'AnnouncementController@update')->name('admin_announcement.update');
    Route::get('/announcements/{announcement}/edit', 'AnnouncementController@edit')->name('admin_announcement.edit');
    Route::get('/announcements', 'AnnouncementController@index')->name('admin_announcement.index');

//    info
    Route::get('/info/create', 'InfoController@create')->name('admin_info.create');
    Route::post('/info/store', 'InfoController@store')->name('admin_info.store');
    Route::post('/info/{announcement}/update', 'InfoController@update')->name('admin_info.update');
    Route::get('/info/{announcement}/edit', 'InfoController@edit')->name('admin_info.edit');
    Route::get('/info', 'InfoController@index')->name('admin_info.index');


// vote
    Route::get('/votes/create', 'VoteController@create')->name('admin_vote.create');
    Route::post('/votes/store', 'VoteController@store')->name('admin_vote.store');
    Route::post('/votes/{vote}/update', 'VoteController@update')->name('admin_vote.update');
    Route::post('/votes/{vote}/submitVote', 'VoteController@submitVote')->name('admin_vote.submitVote');

    Route::get('/votes/{vote}/edit', 'VoteController@edit')->name('admin_vote.edit');
    Route::get('/votes/{vote}/vote', 'VoteController@vote')->name('admin_vote.vote');
    Route::get('/votes/{vote}/result', 'VoteController@result')->name('admin_vote.result');

    Route::get('/votes', 'VoteController@index')->name('admin_vote.index');


//    permission
    Route::get('/permissions', 'CompanyPermissionController@index')->name('admin_permission.index');
    Route::get('/permissions/{permission}/edit', 'CompanyPermissionController@edit')->name('admin_permission.edit');
    Route::post('/permissions/{permission}/update', 'CompanyPermissionController@update')->name('admin_permission.update');


});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('home');
});


Route::group([], function () {
    Route::get('/front_end/login', 'LoginController@index')->name('front_end_login.index');
    Route::post('/front_end/login', 'LoginController@login')->name('front_end.login');
    Route::get('/front_end/logout', 'LoginController@logout')->name('front_end.logout');


    Route::get('/announcement', 'AnnouncementController@index')->name('announcement');
    Route::get('/search', 'AnnouncementController@index_search')->name('search');

    Route::get('/vote', 'VoteController@index')->name('vote');


});


