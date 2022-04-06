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

/**
 * Auth Route
 */

use Illuminate\Routing\RouteGroup;

Auth::routes(['register' => false]);

/**
 * Panel Route
 */
Route::group([ 'prefix' => 'panel', 'middleware' => [ 'auth', 'auth.panel' ] ], function() {

    // Dashboard
	Route::get('/', 'Panel\HomeController@index')->name('home');

	// User
	Route::group([ 'middleware' => 'auth.admin', 'prefix' => 'users'], function() {
		Route::get('/', 'Panel\UserController@index')->name('user');
        Route::get('/data', 'Panel\UserController@getData')->name('user.data');
        Route::get('create', 'Panel\UserController@create')->name('user.create');
        Route::post('create', 'Panel\UserController@store')->name('user.data.create');
        Route::get('{userId}/edit', 'Panel\UserController@edit')->name('user.edit');
        Route::post('{userId}/edit', 'Panel\UserController@update')->name('user.data.edit');
        Route::delete('{userId}/delete', 'Panel\UserController@destroy')->name('user.data.delete');
	});

    // News
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'Panel\NewsController@index')->name('news');
        Route::get('/data', 'Panel\NewsController@getData')->name('news.data');
        Route::get('create', 'Panel\NewsController@create')->name('news.create');
        Route::post('create', 'Panel\NewsController@store')->name('news.data.create');
        Route::get('{newsId}/edit', 'Panel\NewsController@edit')->name('news.edit');
        Route::put('{newsId}/edit', 'Panel\NewsController@update')->name('news.data.edit');
        Route::delete('{newsId}/delete', 'Panel\NewsController@destroy')->name('news.data.delete');
    });

    // Member
    Route::group(['prefix' => 'member'], function () {
        Route::get('/', 'Panel\MemberController@index')->name('member');
        Route::get('/data', 'Panel\MemberController@getData')->name('member.data');
        Route::get('create', 'Panel\MemberController@create')->name('member.create');
        Route::post('create', 'Panel\MemberController@store')->name('member.data.create');
        Route::get('{memberId}/edit', 'Panel\MemberController@edit')->name('member.edit');
        Route::put('{memberId}/edit', 'Panel\MemberController@update')->name('member.data.edit');
        Route::delete('{memberId}/delete', 'Panel\MemberController@destroy')->name('member.data.delete');
        Route::put('{memberId}/status/change', 'Panel\MemberController@updateStatuMember')->name('member.data.change.status');
    });

    // Gallery
    Route::prefix('gallery')->group(function () {
        Route::get('/', 'Panel\GalleryController@index')->name('gallery');
        Route::get('create', 'Panel\GalleryController@create')->name('gallery.create');
        Route::get('detail/{galleryId}', 'Panel\GalleryController@gallery')->name('gallery.detail');
        Route::get('data', 'Panel\GalleryController@getData')->name('gallery.data');
        Route::get('{galleryId}/data', 'Panel\GalleryController@getDataDetail')->name('gallery.data.detail');
        Route::post('{galleryId}/create', 'Panel\GalleryController@store')->name('gallery.data.create');
        Route::post('create', 'Panel\GalleryController@storeNewGallery')->name('gallery.data.create.new');
        Route::delete('{galleryId}/delete', 'Panel\GalleryController@destroy')->name('gallery.data.delete');
        Route::delete('{galleryId}/{galleryDetailId}/delete', 'Panel\GalleryController@destroyImage')->name('gallery.data.delete.detail');
    });

    // Product
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'Panel\ProductController@index')->name('product');
        Route::get('/data', 'Panel\ProductController@getData')->name('product.data');
        Route::get('create', 'Panel\ProductController@create')->name('product.create');
        Route::post('create', 'Panel\ProductController@store')->name('product.data.create');
        Route::get('{productId}/edit', 'Panel\ProductController@edit')->name('product.edit');
        Route::put('{productId}/edit', 'Panel\ProductController@update')->name('product.data.edit');
        Route::delete('{productId}/delete', 'Panel\ProductController@destroy')->name('product.data.delete');
    });

    // Video
    Route::group(['prefix' => 'video'], function () {
        Route::get('/', 'Panel\VideoController@index')->name('video');
        Route::get('/data', 'Panel\VideoController@getData')->name('video.data');
        Route::get('create', 'Panel\VideoController@create')->name('video.create');
        Route::post('create', 'Panel\VideoController@store')->name('video.data.create');
        Route::get('{videoId}/edit', 'Panel\VideoController@edit')->name('video.edit');
        Route::put('{videoId}/edit', 'Panel\VideoController@update')->name('video.data.edit');
        Route::delete('{videoId}/delete', 'Panel\VideoController@destroy')->name('video.data.delete');
    });

    // Business Unit
    Route::group(['prefix' => 'business_unit'], function () {
        Route::get('/', 'Panel\BusinessUnitController@index')->name('business_unit');
        Route::get('/data', 'Panel\BusinessUnitController@getData')->name('business_unit.data');
        Route::get('create', 'Panel\BusinessUnitController@create')->name('business_unit.create');
        Route::post('create', 'Panel\BusinessUnitController@store')->name('business_unit.data.create');
        Route::get('{businessUnitId}/edit', 'Panel\BusinessUnitController@edit')->name('business_unit.edit');
        Route::put('{businessUnitId}/edit', 'Panel\BusinessUnitController@update')->name('business_unit.data.edit');
        Route::delete('{businessUnitId}/delete', 'Panel\BusinessUnitController@destroy')->name('business_unit.data.delete');
    });

    // Post Image
    Route::prefix('post_image')->group(function () {
        Route::get('data', 'Panel\HomeController@getDataPostImage')->name('post_image.data');
        Route::post('create', 'Panel\HomeController@storeImages')->name('post_image.store');
        Route::delete('{postImageId}/delete', 'Panel\HomeController@destroyImage')->name('post_image.delete');
    });

    // Company Profile
    Route::prefix('company_profile')->group(function () {
        Route::get('/', 'Panel\CompanyProfileController@index')->name('company_profile');
        Route::get('/data', 'Panel\CompanyProfileController@getData')->name('company_profile.data');
        Route::get('type/{companyProfileTypeId}/change', 'Panel\CompanyProfileController@change')->name('company_profile.change');
        Route::put('type/{companyProfileTypeId}/change', 'Panel\CompanyProfileController@update')->name('company_profile.data.change');
    });

	// Others
	Route::get('profile', 'Panel\HomeController@profile')->name('profile');
	Route::post('profile', 'Panel\HomeController@updateProfile')->name('profile.data.edit');
});

// PDF Generator
Route::prefix('pdf')->group(function () {
    Route::get('members/{member}', 'PdfGeneratorController@generateMember')->name('pdf.member');
});


/**
 * Site Route
 */
Route::group([], function () {
    Route::get('/', 'Site\SiteController@index')->name('site');

    // Contact
    Route::prefix('contact')->group(function () {
        Route::get('/', 'Site\SiteController@contact')->name('site.contact');
        Route::post('/', 'Site\SiteController@sendMail')->name('site.contact.send');
    });

    // News
    Route::prefix('news')->group(function () {
        Route::get('/', 'Site\SiteController@news')->name('site.news');
        Route::get('detail/{news}', 'Site\SiteController@newsDetail')->name('site.news.detail');
    });

    // Product
    Route::prefix('product')->group(function () {
        Route::get('/', 'Site\SiteController@product')->name('site.product');
        Route::get('{product}', 'Site\SiteController@productDetail')->name('site.product.detail');
    });

    // Video
    Route::prefix('video')->group(function () {
        Route::get('/', 'Site\SiteController@video')->name('site.video');
        Route::get('{video}', 'Site\SiteController@videoDetail')->name('site.video.detail');
    });

    // Gallery
    Route::prefix('gallery')->group(function () {
        Route::get('/', 'Site\SiteController@galleries')->name('site.gallery');
        Route::get('{gallery}', 'Site\SiteController@galleryDetail')->name('site.gallery.detail');
    });

    // Organization
    Route::prefix('organization')->group(function () {
        Route::get('profile', 'Site\SiteController@organizationProfile')->name('site.organization.profile');
        Route::get('rule', 'Site\SiteController@organizationRule')->name('site.organization.rule');
        Route::get('report', 'Site\SiteController@organizationReport')->name('site.organization.report');
    });

    // Members
    Route::prefix('members')->group(function () {
        Route::get('list', 'Site\MemberSiteController@memberList')->name('site.member.list');
        Route::get('register', 'Site\MemberSiteController@memberRegister')->name('site.member.register');
        Route::post('register', 'Site\MemberSiteController@saveDataMember')->name('site.member.register.data');
        Route::get('constribution', 'Site\MemberSiteController@memberConstribution')->name('site.member.constribution');
    });

    // Members
    Route::prefix('unit_usaha')->group(function () {
        Route::get('{businessUnit}', 'Site\SiteController@businessUnit')->name('site.unit_usaha.detail');
    });
});
