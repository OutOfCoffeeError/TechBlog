<?php

use App\Helpers\CommonHelper;
// use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

Route::get('/', 'CommonController@index');

Route::get('/test/{id}', function ($id) {
    return 'Token is: '.CommonHelper::generateB64Token($id);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('post', 'PostController');

Route::get('/tokencallback', function(Request $request) {
    Cache::put('cachekey', "CACHE VALUE");

    return $request->fullUrl();
    // return view('pages.auth.oauthcallback');
});

Route::get('/getcache', function () {
    return Cache::get('cachekey', 'default');
});