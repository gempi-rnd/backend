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

Route::prefix('auth')->group(function () {
    Route::post('login', App\Http\Controllers\AuthController::class . '@login')->name('login.api');
    Route::post('register', App\Http\Controllers\AuthController::class . '@register')->name('register.api');
});

Route::get('/login/{provider}', [App\Http\Controllers\AuthController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [App\Http\Controllers\AuthController::class, 'handleProviderCallback']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', App\Http\Controllers\AuthController::class . '@logout')->name('logout.api');
    Route::get('me', App\Http\Controllers\MeController::class . '@me')->name('me.api');
    Route::get('user', App\Http\Controllers\AuthController::class . '@profile')->name('profile.api');
    Route::apiResource('/students', App\Http\Controllers\StudentController::class);
    Route::apiResource('/tenants', App\Http\Controllers\TenantController::class);
    Route::apiResource('/question-types', App\Http\Controllers\QuestionTypeController::class);
    Route::apiResource('/difficult-levels', App\Http\Controllers\DifficultyLevelController::class);
    Route::apiResource('/group-topics', App\Http\Controllers\GroupTopicController::class);
    Route::apiResource('/questions', App\Http\Controllers\QuestionController::class);
    Route::apiResource('/tests', App\Http\Controllers\TestController::class);
    Route::apiResource('/test-questions', App\Http\Controllers\TestQuestionController::class);
    Route::apiResource('/test-question-sessions', App\Http\Controllers\TestQuestionSessionController::class);
    Route::apiResource('/test-sessions', App\Http\Controllers\TestSessionController::class);
    Route::apiResource('/topics', App\Http\Controllers\TopicController::class);
    Route::post('generate-test-question-qessions', App\Http\Controllers\TestQuestionSessionController::class . '@generateTestQuestionSessions');
});
