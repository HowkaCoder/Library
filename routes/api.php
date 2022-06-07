<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FacultetController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\JanreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('facultets' , FacultetController::class);

Route::resource('groups' , GroupController::class);

Route::resource('students' , StudentController::class);

Route::resource('authors' , AuthorController::class);

Route::resource('janres' , JanreController::class);

Route::resource('books' , BookController::class);
 
Route::resource('orders' ,OrderController::class);

Route::any('/search/{search}' , [SearchController::class , 'search']);

Route::any('/student_serch/{search}' ,[SearchController::class , 'student_search']);
