<?php

use Illuminate\Support\Facades\Route;

//dashboard routes
Route::get('dashboard/', 'App\Http\Controllers\Dashboard\HomeController@index')->name('dashboard')->middleware('auth');

Route::resource('dashboard/cities', 'App\Http\Controllers\Dashboard\CityController')->except('show', 'delete')->middleware('auth');
Route::resource('dashboard/locations', 'App\Http\Controllers\Dashboard\LocationController')->except('show')->middleware('auth');
Route::resource('dashboard/activities', 'App\Http\Controllers\Dashboard\ActivityController')->except('show', 'create')->middleware('auth');
Route::resource('dashboard/types', 'App\Http\Controllers\Dashboard\TypeController')->except('show', 'create')->middleware('auth');
Route::resource('dashboard/services', 'App\Http\Controllers\Dashboard\ServiceController')->middleware('auth');

Route::get('dashboard/users', 'App\Http\Controllers\Dashboard\UserController@index')->name('user.index')->middleware('auth');
Route::post('dashboard/users', 'App\Http\Controllers\Dashboard\UserController@store')->name('user.store')->middleware('auth');

Route::get('dashboard/preferences', 'App\Http\Controllers\Dashboard\PreferenceController@index')->name('preference.index')->middleware('auth');
Route::put('dashboard/preferences/{preference}', 'App\Http\Controllers\Dashboard\PreferenceController@update')->name('preference.update')->middleware('auth');

Route::get('dashboard/districts', 'App\Http\Controllers\Dashboard\DistrictController@index')->name('district.index')->middleware('auth');
Route::get('dashboard/districts/{district}/edit', 'App\Http\Controllers\Dashboard\DistrictController@edit')->name('district.edit')->middleware('auth');
Route::put('dashboard/districts/{district}', 'App\Http\Controllers\Dashboard\DistrictController@update')->name('district.update')->middleware('auth');

//polymorphic routes
Route::get('dashboard/addresses/{address}/edit', 'App\Http\Controllers\Dashboard\ModifyAddressController@edit')->name('address.edit')->middleware('auth');
Route::put('dashboard/addresses/{address}/', 'App\Http\Controllers\Dashboard\ModifyAddressController@update')->name('address.edit')->middleware('auth');

Route::get('dashboard/contacts/{type}/{id}/create', 'App\Http\Controllers\Dashboard\ContactController@create')->name('contact.create')->middleware('auth');
Route::post('dashboard/contacts/{type}/{id}', 'App\Http\Controllers\Dashboard\ContactController@store')->name('contact.store')->middleware('auth');
Route::delete('dashboard/contacts/{contact}', 'App\Http\Controllers\Dashboard\ContactController@destroy')->name('contact.destroy')->middleware('auth');
Route::get('dashboard/contacts/{contact}/edit', 'App\Http\Controllers\Dashboard\ContactController@edit')->name('contact.edit')->middleware('auth');
Route::put('dashboard/contacts/{contact}/', 'App\Http\Controllers\Dashboard\ContactController@update')->name('contact.edit')->middleware('auth');

Route::get('dashboard/photos/{type}/{id}/create', 'App\Http\Controllers\Dashboard\PhotoController@create')->name('photo.create')->middleware('auth');
Route::post('dashboard/photos/{type}/{id}', 'App\Http\Controllers\Dashboard\PhotoController@store')->name('photo.store')->middleware('auth');
Route::delete('dashboard/photos/{image}', 'App\Http\Controllers\Dashboard\PhotoController@destroy')->name('photo.destroy')->middleware('auth');
Route::get('dashboard/photos/mark-as-primary/{image}', 'App\Http\Controllers\Dashboard\PhotoController@mark')->name('photo.mark')->middleware('auth');
Route::get('dashboard/photos/{type}/{id}', 'App\Http\Controllers\Dashboard\PhotoController@show')->name('photo.index')->middleware('auth');

//auth routes
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login.form');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::get('logout', 'App\Http\Controllers\Auth\LogoutController@logout')->name('logout');
Route::get('reset-password/{user}', 'App\Http\Controllers\Auth\ResetPasswordController@edit')->name('reset.edit')->middleware('auth');
Route::put('reset-password/{user}', 'App\Http\Controllers\Auth\ResetPasswordController@update')->name('reset.update')->middleware('auth');
Route::get('change-password/', 'App\Http\Controllers\Auth\ChangePasswordController@edit')->name('change.edit')->middleware('auth');
Route::put('change-password/', 'App\Http\Controllers\Auth\ChangePasswordController@update')->name('change.update')->middleware('auth');

//web routes

Route::get('/', 'App\Http\Controllers\Web\HomeController@index')->name('homepage');
Route::get('{district:slug}', 'App\Http\Controllers\Web\HomeController@show')->name('district-page');
Route::get('{district:slug}/sobre-el-departamento', 'App\Http\Controllers\Web\HomeController@about')->name('district-about');

Route::get('{district:slug}/experiencias', 'App\Http\Controllers\Web\ActivityController@index')->name('activities-page');
Route::get('{district:slug}/experiencias/{activity:slug}', 'App\Http\Controllers\Web\ActivityController@show')->name('activity-page');

Route::get('{district:slug}/gastronomia', 'App\Http\Controllers\Web\FoodServiceController@index')->name('foodservices-page');
Route::get('{district:slug}/gastronomia/{service:slug}', 'App\Http\Controllers\Web\FoodServiceController@show')->name('foodservice-page');

Route::get('{district:slug}/alojamiento', 'App\Http\Controllers\Web\LodgingServiceController@index')->name('lodging-page');
Route::get('{district:slug}/alojamiento/{service:slug}', 'App\Http\Controllers\Web\LodgingServiceController@show')->name('lodging-single-page');

Route::get('{district:slug}/transporte', 'App\Http\Controllers\Web\TransportServiceController@index')->name('transport-page');

Route::get('{district:slug}/localidades', 'App\Http\Controllers\Web\CityController@index')->name('cities-page');
Route::get('{district:slug}/localidades/{city:slug}', 'App\Http\Controllers\Web\CityController@show')->name('city-page');

Route::get('{district:slug}/lugares', 'App\Http\Controllers\Web\LocationController@index')->name('locations-page');
Route::get('{district:slug}/lugares/{location:slug}', 'App\Http\Controllers\Web\LocationController@show')->name('location-page');


