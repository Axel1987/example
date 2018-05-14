<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * Authentications routes
 */
Route::group(['namespace' => 'Auth'], function () {
    Route::post('/sign-in', 'SecurityController@signIn');
    Route::post('/sign-up', 'SecurityController@signUp');
    Route::get('/refresh-token', 'SecurityController@refreshToken');
});

/**
 * Methods for all authenticated users
 */
Route::group(['middleware' => ['jwt.auth', 'role:admin|partner|client']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController@view');
        Route::post('{user}', 'ProfileController@edit');
        Route::delete('', 'ProfileController@delete');
    });
});

/**
 * Admin routes
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['jwt.auth', 'role:admin']], function () {

    /** Routes of users */
    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'UsersController@index');
        Route::get('list', 'UsersController@getList');
        Route::put('{user}', 'UsersController@edit');
        Route::post('', 'UsersController@create');
    });

    /** Routes of candidates */
    Route::group(['prefix' => 'candidates'], function () {
        Route::get('', 'CandidateController@index');
        Route::post('{candidate}', 'CandidateController@edit');
        Route::post('', 'CandidateController@create');
    });

    /** Routes of partner candidates */
    Route::group(['prefix' => 'partner-candidates'], function () {
        Route::get('', 'PartnerCandidateController@index');
        Route::post('{partnerCandidate}', 'PartnerCandidateController@edit');
        Route::post('', 'PartnerCandidateController@create');
    });

    /** Routes of jobs */
    Route::group(['prefix' => 'jobs'], function () {
        Route::get('', 'JobsController@index');
        Route::put('{job}', 'JobsController@edit');
        Route::post('', 'JobsController@create');
    });

    /** Routes of reviews */
    Route::group(['prefix' => 'reviews'], function () {
        Route::get('', 'ReviewsController@index');
    });

    /** Routes of roles */
    Route::group(['prefix' => 'roles'], function () {
        Route::get('', 'RoleController@index');
    });
});

/**
 * Talent router
 */
Route::group(['namespace' => 'Talent', 'prefix' => 'talent', 'middleware' => ['jwt.auth', 'role:partner']], function () {
    
    /** Routes of jobs */
    Route::group(['prefix' => 'jobs'], function () {
        Route::get('', 'JobsController@index');
    });

    /** Routes of candidates */
    Route::group(['prefix' => 'candidates'], function () {
        Route::get('', 'CandidateController@index');
    });

    /** Routes of partner candidates */
    Route::group(['prefix' => 'partner-candidates'], function () {
        Route::get('', 'PartnerCandidateController@index');
    });

    /** Routes of reviews */
    Route::group(['prefix' => 'reviews'], function () {
        Route::get('', 'ReviewsController@index');
    });
});

/**
 * Client routes
 */
Route::group(['namespace' => 'Client', 'prefix' => 'client', 'middleware' => ['jwt.auth', 'role:client']], function () {
    /** Routes of reviews */
    Route::group(['prefix' => 'reviews'], function () {
        Route::get('', 'ReviewController@index');
        Route::get('{review}', 'ReviewController@view');
        Route::post('', 'ReviewController@create');
        Route::put('{review}', 'ReviewController@edit');
        Route::delete('{review}', 'ReviewController@delete');
    });

    /** Routes of jobs */
    Route::group(['prefix' => 'jobs'], function () {
        Route::get('', 'JobsController@index');
        Route::get('{job}', 'JobsController@view');
        Route::post('', 'JobsController@create');
        Route::put('{job}', 'JobsController@edit');
        Route::delete('{job}', 'JobsController@delete');
    });
});

/**
 * Public methods
 */
/** Routes of seekers */
Route::group(['prefix' => 'seeker'], function () {
    Route::post('cv', 'SeekerController@cv');
});

/** Routes of partner */
Route::group(['prefix' => 'partner'], function () {
    Route::get('list', 'PartnerController@getList');
    Route::post('cv', 'PartnerController@cv');
});

/**
 * Upload files
 */
Route::group(['middleware' => ['jwt.auth', 'role:admin']], function () {
    Route::group(['prefix' => 'upload'], function () {
        Route::post('resume', 'UploadController@resume');
    });
});