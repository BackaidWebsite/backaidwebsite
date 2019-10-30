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
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'PagesController@login');
});
Auth::routes();

Route::group(['namespace' => 'admin'],function() {
    Route::group(['middleware' => 'roles', 'roles' => ['Admin']], function () {

        Route::get('/admin', 'homeController@index');
        Route::resource('/admin/users', 'userController');

        Route::resource('/admin/articles', 'articleController');
        Route::get('/admin/articles/category/{category}', ['as' => 'articles.category', 'uses' => 'articleController@bycategory'])->where('category', '[\w\d\-\_]+');
        Route::resource('/admin/articlecategories', 'articlecategoryController');

        Route::resource('/admin/faq', 'faqController');

        Route::resource('/admin/threadcategories', 'threadcategoryController');
        Route::get('/admin/forum/category/{category}', ['as' => 'adminforums.category', 'uses' => 'forumController@bycategory'])->where('category', '[\w\d\-\_]+');
        Route::resource('/admin/forum', 'forumController');



        Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
             \UniSharp\LaravelFilemanager\Lfm::routes();
        });
    });
});

Route::group(['namespace' => 'user'],function() {
    Route::group(['middleware' => 'roles', 'roles' => ['Admin', 'User']], function () {

        Route::get('/articles', ['uses' => 'articlesController@index', 'as' => 'userarticles.index']);
        Route::get('/articles/category/{category}', ['as' => 'userarticles.category', 'uses' => 'articlesController@bycategory'])->where('category', '[\w\d\-\_]+');
        Route::get('/articles/{slug}', ['as' => 'userarticles.show', 'uses' => 'articlesController@show'])->where('slug', '[\w\d\-\_]+');
        Route::resource('/profile', 'profileController');

        Route::get('/faq', ['as' => 'userfaq.index', 'uses' => 'faqController@index']);
        Route::resource('/forums', 'forumController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'bycategory']]);
        Route::get('/forums/{slug}', ['as' => 'forums.show', 'uses' => 'forumController@show'])->where('slug', '[\w\d\-\_]+');
        Route::get('/forums/category/{category}', ['as' => 'forums.category', 'uses' => 'forumController@bycategory'])->where('category', '[\w\d\-\_]+');

        Route::post('/comments/{articleID}/create', ['uses' => 'commentsController@store', 'as' => 'usercomments.store']);
        Route::put('/comments/{commentID}/update', ['uses' => 'commentsController@update', 'as' => 'usercomments.update']);
        Route::delete('comments/{commentID}/delete', ['uses' => 'commentsController@destroy', 'as' => 'usercomments.destroy']);

        Route::post('/comments/reply/{commentID}/create', ['uses' => 'commentsreplyController@store', 'as' => 'commentsreply.store']);
        Route::put('/comments/reply/{id}/update', ['uses' => 'commentsreplyController@update', 'as' => 'commentsreply.update']);
        Route::delete('comments/comment/{commentID}/delete', ['uses' => 'commentsreplyController@destroy', 'as' => 'commentsreply.destroy']);


        Route::post('/replies/{threadID}/create', ['uses' => 'repliesController@store', 'as' => 'usereply.store']);
        Route::put('/replies/{repliesID}/update', ['uses' => 'repliesController@update', 'as' => 'usereply.update']);
        Route::delete('replies/{repliesID}/delete', ['uses' => 'repliesController@destroy', 'as' => 'usereply.destroy']);

        Route::post('/replies/reply/{repliesID}/create', ['uses' => 'repliesreplyController@store', 'as' => 'threadreply.store']);
        Route::put('/replies/reply/{id}/update', ['uses' => 'repliesreplyController@update', 'as' => 'threadreply.update']);
        Route::delete('replies/reply/{id}/delete', ['uses' => 'repliesreplyController@destroy', 'as' => 'threadreply.destroy']);


    });
});
Route::group(['middleware' => 'guest'], function () {
    Route::fallback(function() {
        return view('errors.guests');
    });
});
Route::group(['middleware' => 'auth'], function () {
    Route::fallback(function() {
        return view('errors.users');
    });
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
