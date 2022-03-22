<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Sample;



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/trip', [TripController::class, 'index'])->name('dashboard.trip');
Route::resource('dashboard/sample', Sample::class);

Route::resource('dashboard/driver', DriverController::class);
Route::get('/dashboard/driver/', [DriverController::class, 'index'])->name('dashboard.driver');
Route::get('/dashboard/driver/api/getdata/{id?}', [DriverController::class, 'getData'])->name('dashboard.driver.api.getdata');

Route::resource('/dashboard/truck', TruckController::class);
Route::get('/dashboard/truck', [TruckController::class, 'index'])->name('dashboard.truck');

Route::resource('/dashboard/company', CompanyController::class);
Route::get('/dashboard/company', [CompanyController::class, 'index'])->name('dashboard.company');


Route::get('/dashboard/report', [ReportController::class, 'index'])->name('dashboard.report');

Route::resource('/dashboard/settings', SettingsController::class);
Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard.settings');