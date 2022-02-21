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

Auth::routes(['register' => false]);

// Panel route
Route::group([ 'prefix' => 'panel', 'middleware' => [ 'auth', 'auth.panel' ] ], function() {
    // home
	Route::get('/', 'Panel\HomeController@index')->name('home');

	// user
	Route::group([ 'middleware' => 'auth.admin', 'prefix' => 'users'], function() {

		Route::get('/', 'Panel\UserController@index')->name('user');
			Route::get('/data', 'Panel\UserController@getData')->name('user.data');
			Route::get('create', 'Panel\UserController@create')->name('user.create');
			Route::post('create', 'Panel\UserController@store')->name('user.data.create');
			Route::get('{userId}/edit', 'Panel\UserController@edit')->name('user.edit');
			Route::post('{userId}/edit', 'Panel\UserController@update')->name('user.data.edit');
			Route::delete('{userId}/delete', 'Panel\UserController@destroy')->name('user.data.delete');
	});

    // news
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'Panel\NewsController@index')->name('news');
        Route::get('/data', 'Panel\NewsController@getData')->name('news.data');
        Route::get('create', 'Panel\NewsController@create')->name('news.create');
        Route::post('create', 'Panel\NewsController@store')->name('news.data.create');
        Route::get('{newsId}/edit', 'Panel\NewsController@edit')->name('news.edit');
        Route::put('{newsId}/edit', 'Panel\NewsController@update')->name('news.data.edit');
        Route::delete('{newsId}/delete', 'Panel\NewsController@destroy')->name('news.data.delete');
    });

    // member
    Route::group(['prefix' => 'member'], function () {
        Route::get('/', 'Panel\MemberController@index')->name('member');
        Route::get('/data', 'Panel\MemberController@getData')->name('member.data');
        Route::get('create', 'Panel\MemberController@create')->name('member.create');
        Route::post('create', 'Panel\MemberController@store')->name('member.data.create');
        Route::get('{memberId}/edit', 'Panel\MemberController@edit')->name('member.edit');
        Route::put('{memberId}/edit', 'Panel\MemberController@update')->name('member.data.edit');
        Route::delete('{memberId}/delete', 'Panel\MemberController@destroy')->name('member.data.delete');
    });

    Route::prefix('gallery')->group(function () {
        Route::get('/', 'Panel\GalleryController@index')->name('gallery');
        Route::get('/data', 'Panel\GalleryController@getData')->name('gallery.data');
        Route::post('create', 'Panel\GalleryController@store')->name('gallery.data.create');
        Route::delete('{galleryId}/delete', 'Panel\GalleryController@destroy')->name('gallery.data.delete');
    });

	// Others
	Route::get('profile', 'Panel\HomeController@profile')->name('profile');
	Route::post('profile', 'Panel\HomeController@updateProfile')->name('profile.data.edit');
});

Route::group([], function () {
    Route::get('/', 'Site\SiteController@index')->name('site');

    Route::prefix('contact')->group(function () {
        Route::get('/', 'Site\SiteController@contact')->name('site.contact');
        Route::post('/', 'Site\SiteController@sendMail')->name('site.contact.send');
    });

    // News
    Route::prefix('news')->group(function () {
        Route::get('/', 'Site\SiteController@news')->name('site.news');
        Route::get('detail/{newsId}', 'Site\SiteController@newsDetail')->name('site.news.detail');
    });

    Route::prefix('organization')->group(function () {
        Route::get('profile', 'Site\SiteController@organizationProfile')->name('site.organization.profile');
        Route::get('rule', 'Site\SiteController@organizationRule')->name('site.organization.rule');
        Route::get('report', 'Site\SiteController@organizationReport')->name('site.organization.report');
    });

    Route::prefix('members')->group(function () {
        Route::get('list', 'Site\SiteController@memberList')->name('site.member.list');
        Route::get('register', 'Site\SiteController@memberRegister')->name('site.member.register');
        Route::post('register', 'Site\SiteController@saveDataMember')->name('site.member.register.data');
        Route::get('constribution', 'Site\SiteController@memberConstribution')->name('site.member.constribution');
    });
});
