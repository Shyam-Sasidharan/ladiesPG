<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('throttle:10,1');
});
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/settings', [AdministrationController::class, 'settings'])->name('settings');
    Route::post('/settings/property', [AdministrationController::class, 'saveSettings'])->name('settings.property');
    Route::post('/settings/password', [AuthController::class, 'password'])->name('password.update');
    Route::get('/notifications', [AdministrationController::class, 'notifications'])->name('notifications.index');
    Route::post('/notifications/refresh', [AdministrationController::class, 'refreshNotifications'])->name('notifications.refresh');
    Route::post('/notifications/{notification}/read', [AdministrationController::class, 'readNotification'])->name('notifications.read');
    Route::get('/documents', [AdministrationController::class, 'documents'])->name('documents.index');
    Route::get('/residents/{resident}/photo', [ResidentController::class, 'photo'])->name('residents.photo');
    Route::resource('residents', ResidentController::class);
    Route::get('/floors', [PropertyController::class, 'floors'])->name('floors.index');
    Route::post('/floors', [PropertyController::class, 'saveFloor'])->name('floors.store');
    Route::put('/floors/{floor}', [PropertyController::class, 'saveFloor'])->name('floors.update');
    Route::delete('/floors/{floor}', [PropertyController::class, 'deleteFloor'])->name('floors.destroy');
    Route::get('/rooms', [PropertyController::class, 'rooms'])->name('rooms.index');
    Route::get('/rooms/create', [PropertyController::class, 'roomForm'])->name('rooms.create');
    Route::post('/rooms', [PropertyController::class, 'saveRoom'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [PropertyController::class, 'roomForm'])->name('rooms.edit');
    Route::put('/rooms/{room}', [PropertyController::class, 'saveRoom'])->name('rooms.update');
    Route::delete('/rooms/{room}', [PropertyController::class, 'deleteRoom'])->name('rooms.destroy');
    Route::put('/beds/{bed}', [PropertyController::class, 'updateBed'])->name('beds.update');
    Route::get('/allocation', [AllocationController::class, 'index'])->name('allocation.index');
    Route::get('/floor-plan', [AllocationController::class, 'index'])->name('floor-plan');
    Route::get('/beds/{bed}', [AllocationController::class, 'bed'])->name('beds.show');
    Route::post('/allocation', [AllocationController::class, 'store'])->name('allocation.store');
    Route::post('/transfer', [AllocationController::class, 'transfer'])->name('allocation.transfer');
    Route::post('/residents/{resident}/checkout', [AllocationController::class, 'checkout'])->name('residents.checkout');
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::post('/billing/generate', [BillingController::class, 'generate'])->name('billing.generate');
    Route::post('/payments', [BillingController::class, 'pay'])->name('payments.store');
    Route::put('/rent/{record}/late-fee', [BillingController::class, 'lateFee'])->name('rent.late-fee');
    Route::post('/residents/{resident}/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('/reports',[ReportController::class, 'index'])->name('reports.index');
});
