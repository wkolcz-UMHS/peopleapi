<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|,'middleware' => ['auth:sanctum']
*/

Route::post('/authenticate',[UserController::class,'authenticate'])->name('auth');

Route::group(['prefix' => 'v1','middleware' => ['auth:sanctum']], function () {

    Route::get('/applicants',[ApplicantController::class, 'fetch_all'])->name('fetch-applicants');

    Route::get('/applicant/{id}',[ApplicantController::class, 'fetch'])->name('fetch-applicant');

    Route::get('/applicant/search/{name}/{page?}',[ApplicantController::class, 'search'])->name('search-applicants');

    Route::post('/applicant/{id}',[ApplicantController::class, 'update_applicant'])->name('update-applicant');

    Route::post('/applicant',[ApplicantController::class, 'create_applicant'])->name('create-applicant');

    Route::delete('/applicant/{id}',[ApplicantController::class, 'delete_applicant'])->name('delete-applicant');

});

