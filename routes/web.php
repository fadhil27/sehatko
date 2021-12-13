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

Route::get('administrator','AdminController@dashboard')->name('dashboard')->middleware('auth');
Route::group(['middleware' => 'auth', 'prefix' => 'administrator'],function (){
    Route::resource('admin','AdminController');
    Route::resource('agenda','AgendaController');
    Route::resource('blog','BlogController');
    Route::resource('category','CategoryController');
    Route::resource('contact','ContactController');
    Route::resource('gallery','GalleryController');
    Route::resource('jumbotron','JumbotronController');
    Route::resource('inbox','InboxController');
    Route::resource('organizer','OrganizerController');
    Route::resource('youtube','YoutubeController');
    Route::resource('scholarship','ScholarshipController');
    Route::resource('testimony','TestimonyController');
});

Route::get('/logout','AuthController@logout')->middleware('auth')->name('logout');

Route::group(['middleware'=>'guest'], function(){
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login/submit','AuthController@submitLogin');
});

//HOME ROUTING
Route::get('/', 'HomeController@index')->name('home.index');
Route::group(['prefix' => '/'], function (){
    Route::get('/about', 'HomeController@about')->name('home.about');;
    Route::get('/core-team', 'HomeController@coreTeam')->name('home.coreTeam');
    Route::get('/gallery', 'HomeController@gallery')->name('home.gallery');
    Route::get('/agenda', 'HomeController@agenda')->name('home.agenda');
    Route::get('/agenda/json', 'HomeController@agendaList');
    Route::get('/video', 'HomeController@youtube')->name('home.video');

    //Blog
    Route::get('/blog/all', 'HomeController@blogListAll')->name('home.blogListAll');
    Route::get('/blog/{category}', 'HomeController@blogList')->name('home.blogList');
    Route::get('/blog/{category}/{title}', 'HomeController@singleBlog')->name('home.singleBlog');

    Route::get('/contact-us', 'HomeController@contactUs')->name('home.contactUs');
    Route::post('/send-message', 'HomeController@sendMessage');
    Route::get('/informatoion', 'HomeController@scholarship')->name('home.scholarship');
});