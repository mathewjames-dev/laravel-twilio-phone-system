<?php

use App\Http\Controllers\PhoneController;
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

// Main telephone system.
Route::get('/', function () {
    return view('telephone');
});

/**
 * Access Token for Front-End.
 */
Route::get('/phone/access-token', [PhoneController::class, 'getAccessToken']);
