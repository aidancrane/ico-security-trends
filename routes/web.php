<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['as' => 'landing.show', 'uses' => 'App\Http\Controllers\LandingController@Landing']);
Route::get('/uk-ico-annual-year-totals', ['as' => 'totals.show', 'uses' => 'App\Http\Controllers\ChartController@Totals']);
Route::get('/uk-ico-quarterly-year-totals', ['as' => 'quarterlytotals.show', 'uses' => 'App\Http\Controllers\ChartController@QuarterlyTotals']);
Route::get('/uk-ico-incidents-by-category', ['as' => 'categorytotals.show', 'uses' => 'App\Http\Controllers\ChartController@CategoryTotals']);
Route::get('/uk-ico-incidents-by-sector', ['as' => 'sectortotals.show', 'uses' => 'App\Http\Controllers\ChartController@SectorTotals']);
Route::get('/privacy-policy', ['as' => 'privacy.show', 'uses' => 'App\Http\Controllers\PagesController@PrivacyPolicy']);
