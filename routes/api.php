<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuditoriumController;

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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/get-users', [UserController::class, 'getAllUsers']);
   Route::post('/add-user', [UserController::class, 'addUser']);
   Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
   Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);
   Route::get('/balance/{id}', [UserController::class, 'getBalance']);

   Route::post('/movies', [MovieController::class, 'addMovie']);
   Route::put('/movies/{id}', [MovieController::class, 'editMovie']);
   Route::delete('/movies/{id}', [MovieController::class, 'deleteMovie']);
   Route::get('/movies', [MovieController::class, 'getAllMovies']);
   
   Route::post('/tickets/purchase', [TicketController::class, 'purchase']);
   Route::get('/tickets/purchases', [TicketController::class, 'viewAllPurchases']);
   
   Route::post('/auditoriums', [AuditoriumController::class, 'addAuditorium']);
   Route::get('/getallauditoriums', [AuditoriumController::class, 'getAllAuditoriums']);
   Route::put('/auditoriums/{id}', [AuditoriumController::class, 'edit']);
   Route::delete('/auditoriums/{id}', [AuditoriumController::class, 'destroy']);
   


   Route::post('/logout', [AuthenticationController::class, 'logout']);
});
