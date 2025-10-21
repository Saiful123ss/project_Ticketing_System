<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\MailController;

// ===============================
// EMAIL ROUTES
// ===============================
Route::get('send-email',[MailController::class,'sendEmail']);

// ===============================
// CLIENT ROUTES
// ===============================
Route::get('/', [TicketController::class, 'chooseCategory'])->name('category.choose');
Route::get('/form', [TicketController::class, 'showForm'])->name('ticket.form');
Route::post('/submit-ticket', [TicketController::class, 'submitForm'])->name('ticket.submit');
Route::get('/track', [TicketController::class, 'track'])->name('ticket.track');
Route::post('/track/reply', [TicketController::class, 'addReply'])->name('ticket.reply');
Route::put('tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('ticket.status');

// ===============================
// ADMIN ROUTES
// ===============================

Route::prefix('admin')->group(function () {
    // Login
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');

    // Protected Admin Area
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
        Route::get('tickets/{id}', [AdminController::class, 'showTicket'])->name('admin.ticket.details');
        Route::get('tickets/{id}/replies', [TicketController::class, 'getReplies'])->name('tickets.getReplies');

        Route::post('tickets/{id}/reply', [AdminController::class, 'addReply'])->name('admin.ticket.reply');
        Route::put('tickets/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.ticket.status');

        Route::get('/clients', [AdminController::class, 'clients'])->name('admin.clients');
        Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');

        // Logout
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    });
});

