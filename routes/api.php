<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeStatusController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\PayslipStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by RouteServiceProvider and assigned the "api"
| middleware group. All requests here are prefixed with /api.
|--------------------------------------------------------------------------
*/

// 🔓 Public authentication routes
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login',    [AuthenticationController::class, 'login']);

// 🔐 Protected routes (require Sanctum authentication)
Route::middleware('auth:sanctum')->group(function () {

    // ───── Roles ─────
    Route::get   ('/roles',         [RoleController::class, 'index']);
    Route::get   ('/roles/{id}',    [RoleController::class, 'show']);
    Route::post  ('/roles',         [RoleController::class, 'store']);
    Route::put   ('/roles/{id}',    [RoleController::class, 'update']);
    Route::delete('/roles/{id}',    [RoleController::class, 'destroy']);

    // ───── Users ─────
    Route::get   ('/users',         [UserController::class, 'index']);
    Route::get   ('/users/{id}',    [UserController::class, 'show']);
    Route::post  ('/users',         [UserController::class, 'store']);
    Route::put   ('/users/{id}',    [UserController::class, 'update']);
    Route::delete('/users/{id}',    [UserController::class, 'destroy']);

    // ───── User Statuses ─────
    Route::get   ('/user-statuses',         [UserStatusController::class, 'index']);
    Route::get   ('/user-statuses/{id}',    [UserStatusController::class, 'show']);
    Route::post  ('/user-statuses',         [UserStatusController::class, 'store']);
    Route::put   ('/user-statuses/{id}',    [UserStatusController::class, 'update']);
    Route::delete('/user-statuses/{id}',    [UserStatusController::class, 'destroy']);

    // ───── Employees ─────
    Route::get   ('/employees',         [EmployeeController::class, 'index']);
    Route::get   ('/employees/{id}',    [EmployeeController::class, 'show']);
    Route::post  ('/employees',         [EmployeeController::class, 'store']);
    Route::put   ('/employees/{id}',    [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}',    [EmployeeController::class, 'destroy']);

    // ───── Employee Statuses ─────
    Route::get   ('/employee-statuses',         [EmployeeStatusController::class, 'index']);
    Route::get   ('/employee-statuses/{id}',    [EmployeeStatusController::class, 'show']);
    Route::post  ('/employee-statuses',         [EmployeeStatusController::class, 'store']);
    Route::put   ('/employee-statuses/{id}',    [EmployeeStatusController::class, 'update']);
    Route::delete('/employee-statuses/{id}',    [EmployeeStatusController::class, 'destroy']);

    // ───── Payslips ─────
    Route::get   ('/payslips',         [PayslipController::class, 'index']);
    Route::get   ('/payslips/{id}',    [PayslipController::class, 'show']);
    Route::post  ('/payslips',         [PayslipController::class, 'store']);
    Route::put   ('/payslips/{id}',    [PayslipController::class, 'update']);
    Route::delete('/payslips/{id}',    [PayslipController::class, 'destroy']);

    // ───── Payslip Statuses ─────
    Route::get   ('/payslip-statuses',         [PayslipStatusController::class, 'index']);
    Route::get   ('/payslip-statuses/{id}',    [PayslipStatusController::class, 'show']);
    Route::post  ('/payslip-statuses',         [PayslipStatusController::class, 'store']);
    Route::put   ('/payslip-statuses/{id}',    [PayslipStatusController::class, 'update']);
    Route::delete('/payslip-statuses/{id}',    [PayslipStatusController::class, 'destroy']);

    // 🔓 Logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
