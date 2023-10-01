<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Folder\FolderController;
use App\Http\Controllers\V1\SpellWord\SpellWordController;
use App\Http\Controllers\V1\SpellTest\SpellTestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'auth'] , function (){
    Route::post('login' , [AuthController::class,'login']);
    Route::post('register' , [AuthController::class,'register']);
    Route::get('me' , [AuthController::class,'me'])->middleware('auth:sanctum');
});

Route::group(['middleware' => 'auth:sanctum'] , function(){
    Route::group(['prefix' => 'folder'] , function(){
        Route::get('/' , [FolderController::class,'index']);
        Route::post('/' , [FolderController::class,'store']);
        Route::put('/{folder}' , [FolderController::class,'update']);
        Route::delete('/{folder}' , [FolderController::class,'destroy']);
    });
    Route::group(['prefix' => 'spell-word'] , function(){
        Route::get('/' , [SpellWordController::class,'index']);
        Route::post('/' , [SpellWordController::class,'store']);
        Route::put('/{spell_word}' , [SpellWordController::class,'update']);
        Route::delete('/{spell_word}' , [SpellWordController::class,'destroy']);
    });
    Route::group(['prefix' => 'spell-test'] , function(){
        Route::get('/by-folder' , [SpellTestController::class,'getTestByFolder']);
        Route::get('/by-mistakes' , [SpellTestController::class,'getTestByMistakes']);
        Route::get('/' , [SpellTestController::class,'getTestGeneral']);
        Route::post('/' , [SpellTestController::class,'storeTestResult']);
    });
});
