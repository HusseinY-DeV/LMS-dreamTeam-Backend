<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/file/{filename}', function ($filename) {
    return $filename;
});

// Admins API Routes
Route::prefix('admins')->group(function () {
    /** 
     * /api/admins/register
     * Register an admin
     * */
    Route::post('/register', 'AuthController@register');

    /** 
     * /api/admins/login
     * Check the credentials of an admin
     * */
    Route::post('/login', 'AuthController@login');

    /** 
     * /api/admins/
     * Logout the admin
     * */
    Route::post('/logout', 'AuthController@logout');
});

// Route::group(['middleware' => ['jwt.verify']], function () {

// Admins API Routes
Route::prefix('admins')->group(function () {
    /** 
     * /api/admins/
     * Get all admins
     * */
    Route::get('', 'AuthController@many');

    /** 
     * /api/admins/id
     * Get an admin with the specified id
     * */
    Route::get('{id}', 'AuthController@one');

    /** 
     * /api/admins/id
     * Delete an admin with the specified id
     * */
    Route::delete('{id}', 'AuthController@delete');

    /** 
     * /api/admins/id
     * Update an admin with the specified id
     * Values in the body
     * */
    Route::patch('{id}', 'AuthController@update');
});

// Students API Routes
Route::prefix('students')->group(function () {
    /** 
     * /api/students/
     * Get all students
     * */
    Route::get('', 'StudentsController@many');

    /** 
     * /api/students/id
     * Get a student with the specified id
     * */
    Route::get('{id}', 'StudentsController@one');

    /** 
     * /api/students/
     * Add a student
     * Values in the body
     * */
    Route::post('', 'StudentsController@add');

    /** 
     * /api/students/id
     * Update a student with the specified id
     * Values in the body
     * */
    Route::post('{id}', 'StudentsController@update');

    /** 
     * /api/students/id
     * Delete a student with the specified id
     * */
    Route::delete('{id}', 'StudentsController@delete');
});

// Classes API Routes
Route::prefix('classes')->group(function () {
    /** 
     * /api/classes/
     * Get all classes
     * */
    Route::get('', 'ClassesController@many');

    /** 
     * /api/classes/id
     * Get a class with the specified id
     * */
    Route::get('{id}', 'ClassesController@one');

    /** 
     * /api/classes/
     * Add a class
     * Values in the body
     * */
    Route::post('', 'ClassesController@add');

    /** 
     * /api/classes/id
     * Update a class with the specified id
     * Values in the body
     * */
    Route::patch('{id}', 'ClassesController@update');

    /** 
     * /api/classes/id
     * Delete a class with the specified id
     * */
    Route::delete('{id}', 'ClassesController@delete');
});

// Sections API Routes
Route::prefix('sections')->group(function () {
    /** 
     * /api/sections/
     * Get all sections
     * */
    Route::get('', 'SectionsController@many');

    /** 
     * /api/sections/id
     * Get a section with the specified id
     * */
    Route::get('{id}', 'SectionsController@one');

    /** 
     * /api/sections/
     * Add a section
     * Values in the body
     * */
    Route::post('', 'SectionsController@add');

    /** 
     * /api/sections/id
     * Update a section with the specified id
     * Values in the body
     * */
    Route::patch('{id}', 'SectionsController@update');

    /** 
     * /api/sections/id
     * Delete a section with the specified id
     * */
    Route::delete('{id}', 'SectionsController@delete');
});
// });
