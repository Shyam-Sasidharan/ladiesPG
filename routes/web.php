<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\WebsiteContentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/enquiry', [HomeController::class, 'enquiry'])->name('enquiry.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('throttle:10,1');
});
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/admin', fn () => redirect()->route('dashboard'));
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
    Route::put('/rent/{record}', [BillingController::class, 'updateRecord'])->name('rent.records.update');
    Route::put('/rent/{record}/late-fee', [BillingController::class, 'lateFee'])->name('rent.late-fee');
    Route::get('/accounting', [AccountingController::class, 'summary'])->name('accounting.summary');
    Route::get('/accounting/transactions/create', [AccountingController::class, 'create'])->name('accounting.transactions.create');
    Route::post('/accounting/transactions', [AccountingController::class, 'store'])->name('accounting.transactions.store');
    Route::get('/accounting/transactions', [AccountingController::class, 'history'])->name('accounting.transactions.index');
    Route::get('/accounting/transactions/{transaction}', [AccountingController::class, 'show'])->name('accounting.transactions.show');
    Route::post('/accounting/transactions/{transaction}/reverse', [AccountingController::class, 'reverse'])->name('accounting.transactions.reverse');
    Route::get('/accounting/transactions/{transaction}/attachment', [AccountingController::class, 'attachment'])->name('accounting.transactions.attachment');
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    Route::get('/partners/{partner}/statement', [PartnerController::class, 'statement'])->name('partners.statement');
    Route::post('/residents/{resident}/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Website CMS & Content Management
    Route::prefix('website-content')->name('website.content.')->group(function () {
        Route::get('/', [WebsiteContentController::class, 'index'])->name('index');
        Route::post('/general', [WebsiteContentController::class, 'updateGeneral'])->name('general');
        Route::post('/hero', [WebsiteContentController::class, 'updateHero'])->name('hero');

        Route::post('/rooms', [WebsiteContentController::class, 'storeRoom'])->name('rooms.store');
        Route::put('/rooms/{room}', [WebsiteContentController::class, 'updateRoom'])->name('rooms.update');
        Route::delete('/rooms/{room}', [WebsiteContentController::class, 'destroyRoom'])->name('rooms.destroy');

        Route::post('/facilities', [WebsiteContentController::class, 'storeFacility'])->name('facilities.store');
        Route::put('/facilities/{facility}', [WebsiteContentController::class, 'updateFacility'])->name('facilities.update');
        Route::delete('/facilities/{facility}', [WebsiteContentController::class, 'destroyFacility'])->name('facilities.destroy');

        Route::post('/gallery', [WebsiteContentController::class, 'storeGallery'])->name('gallery.store');
        Route::put('/gallery/{image}', [WebsiteContentController::class, 'updateGallery'])->name('gallery.update');
        Route::delete('/gallery/{image}', [WebsiteContentController::class, 'destroyGallery'])->name('gallery.destroy');

        Route::post('/testimonials', [WebsiteContentController::class, 'storeTestimonial'])->name('testimonials.store');
        Route::put('/testimonials/{testimonial}', [WebsiteContentController::class, 'updateTestimonial'])->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}', [WebsiteContentController::class, 'destroyTestimonial'])->name('testimonials.destroy');

        Route::post('/updates', [WebsiteContentController::class, 'storeUpdate'])->name('updates.store');
        Route::put('/updates/{update}', [WebsiteContentController::class, 'updateUpdate'])->name('updates.update');
        Route::delete('/updates/{update}', [WebsiteContentController::class, 'destroyUpdate'])->name('updates.destroy');
    });
});

// Fallback route for storage files when symlink/junction is not served directly by web server
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    abort_unless(file_exists($filePath), 404);
    $mime = mime_content_type($filePath) ?: 'application/octet-stream';
    return response()->file($filePath, ['Content-Type' => $mime]);
})->where('path', '.*')->name('storage.fallback');

