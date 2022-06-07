<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Sample;
use App\Http\Controllers\UserController;
use App\Models\Expense;
use App\Models\Setting;

// Route::any('/dashboard', function () {
//     //
// })->middleware(['auth']);

//Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard/trip/api/ajaxGetData', [TripController::class, 'ajaxGetData'])->name('trip.ajaxGetData');
    Route::get('/dashboard/trip/ticket-id/{trip_ticket_id?}', [TripController::class, 'showTripTicketDetails'])->name('trip.ticket_id');
    Route::resource('/dashboard/trip', TripController::class);
    Route::get('/dashboard/trip', [TripController::class, 'index'])->name('dashboard.trip');
    Route::get('/dashboard/trip/{startDate?}/{endDate?}', [TripController::class, 'getTripBydateRange'])->name('dashboard.trip.by.date.range');

    Route::resource('dashboard/sample', Sample::class);

    Route::resource('dashboard/driver', DriverController::class);
    Route::get('/dashboard/driver/', [DriverController::class, 'index'])->name('dashboard.driver');
    Route::get('/dashboard/driver/api/getdata/{id?}', [DriverController::class, 'getData'])->name('dashboard.driver.api.getdata');

    Route::resource('/dashboard/truck', TruckController::class);
    Route::get('/dashboard/truck', [TruckController::class, 'index'])->name('dashboard.truck');

    Route::resource('/dashboard/company', CompanyController::class);
    Route::get('/dashboard/company', [CompanyController::class, 'index'])->name('dashboard.company');


    Route::get('/dashboard/report', [ReportController::class, 'index'])->name('dashboard.report');
    Route::get('/dashboard/report/driver/{from?}/{to?}/{id?}', [ReportController::class, 'generateDriverReport'])->name('dashboard.report.driver');
    Route::get('/dashboard/report/company/{from?}/{to?}/{id?}', [ReportController::class, 'generateCompanyReport'])->name('dashboard.report.company');

    Route::resource('/dashboard/settings', SettingsController::class);
    Route::get('/Dashboard/settings/api/ajaxGetData', [SettingsController::class, 'ajaxGetData'])->name('settings.ajaxGetData');
    Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard.settings');

    Route::resource('/dashboard/expense', ExpenseController::class);
    Route::get('/dashboard/expense/api/getAjaxData/{trip?}/{truck?}/{company?}/{driver?}/', [ExpenseController::class, 'getAjaxData'])->name('expense.getAjaxData');

    Route::resource('/dashboard/account', UserController::class);
    Route::get('/dashboard/account', [UserController::class, 'index'])->name('dashboard.account');
});



Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
