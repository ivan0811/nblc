<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\AboutController;

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

// Route::get('/linkstorage', function(){
//     // Artisan::call('storage:link');
//     return response()->json([
//         'message' => true
//     ], 200);
// });

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/subscribe', [SubscribeController::class, 'store']);
Route::get('/news', [NewsController::class, 'show']);
// Route::get('/pagination-news', [NewsController::class, 'show']);
Route::get('/news/{title}', [NewsController::class, 'detail']);
Route::post('/send-reset-password', [UserController::class, 'sendResetPassword']);
Route::post('/reset-password/{token}', [UserController::class, 'resetPassword']);
Route::get('/sponsor', [SponsorController::class, 'show']);
Route::prefix('about')->group(function () {
    Route::get('/', [AboutController::class, 'show']);
    Route::get('/{slug}', [AboutController::class, 'detail']); 
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::patch('/update-profile', [UserController::class, 'updateProfile']);    
    Route::post('/send-email', [SendMailController::class, 'sendMail']);
    Route::patch('update-arternative-email/{id}', [UserController::class, 'updateAlternativeEmail']);

    Route::prefix('/sponsor')->group(function () {
        Route::get('/position', [SponsorController::class, 'getPosition']);        
        Route::post('/', [SponsorController::class, 'store']);
        Route::post('/{id}', [SponsorController::class, 'update']);
        Route::delete('/{id}', [SponsorController::class, 'destroy']);        
    });
    
    Route::prefix('/user')->group(function () {    
        Route::get('/', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::patch('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);                
    });

    Route::prefix('/subscriber')->group(function () {    
        Route::get('/', [SubscribeController::class, 'show']);        
        Route::patch('/{id}', [SubscribeController::class, 'update']);
        Route::delete('/{id}', [SubscribeController::class, 'destroy']);                
    });

    Route::prefix('/news')->group(function () {            
        Route::post('/', [NewsController::class, 'store']);
        Route::post('/{id}', [NewsController::class, 'update']);
        Route::delete('/{id}', [NewsController::class, 'destroy']);                
    });    

    Route::patch('/update/{id}', [AboutController::class, 'update']);    
});
