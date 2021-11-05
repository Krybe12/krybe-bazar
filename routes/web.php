<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\InformationController;
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


Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/offers', [OfferController::class, 'getOffers']);
Route::get('/offer/{offerTag}', [OfferController::class, 'getOffer']);

Route::get('/category/{catName}', [HomeController::class, 'category']);

Route::get('/addlisting', [ListingController::class, 'add'])->middleware('auth');
Route::post('/addlisting', [ListingController::class, 'saveData'])->middleware('auth');

Route::get('/addinformation', [InformationController::class, 'index'])->middleware('auth');
Route::post('/addinformation', [InformationController::class, 'saveInformation'])->middleware('auth');


