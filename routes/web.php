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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Main application route
Route::group([ 'prefix' => 'panel', 'middleware' => [ 'auth', 'auth.panel' ] ], function() {
    // home
	Route::get('/', 'Panel\HomeController@index')->name('home');

	// user
	Route::group([ 'prefix' => 'users'], function() {

		Route::group(['middleware' => 'auth.admin'], function () {
			Route::get('/', 'Panel\UserController@index')->name('user');
			Route::get('/data', 'Panel\UserController@getData')->name('user.data');
			Route::get('create', 'Panel\UserController@create')->name('user.create');
			Route::post('create', 'Panel\UserController@store')->name('user.data.create');
			Route::get('{userId}/edit', 'Panel\UserController@edit')->name('user.edit');
			Route::post('{userId}/edit', 'Panel\UserController@update')->name('user.data.edit');
			Route::get('{userId}/delete', 'Panel\UserController@destroy')->name('user.data.delete');
		});

		// mahasiswa
		Route::group(['prefix' => 'mahasiswa'], function () {
			Route::get('/', 'Panel\MahasiswaController@index')->name('user.mahasiswa');
			Route::get('/data', 'Panel\MahasiswaController@getData')->name('user.mahasiswa.data');
			Route::get('create', 'Panel\MahasiswaController@create')->name('user.mahasiswa.create');
			Route::post('create', 'Panel\MahasiswaController@store')->name('user.mahasiswa.data.create');
		});

        // news
        Route::group(['prefix' => 'news'], function () {
            Route::get('/', 'Panel\NewsController@index')->name('news');
			Route::get('/data', 'Panel\NewsController@getData')->name('news.data');
			Route::get('create', 'Panel\NewsController@create')->name('news.create');
			Route::post('create', 'Panel\NewsController@store')->name('news.data.create');
        });
	});

	// Others
	Route::get('profile', 'Panel\HomeController@profile')->name('profile');
	Route::post('profile', 'Panel\HomeController@updateProfile')->name('profile.data.edit');
});

