<?php

use Illuminate\Support\Facades\Route;

// Redirect root ke admin dashboard
Route::redirect('/', 'admin');

// Jika Anda ingin ke login langsung, ganti baris di atas menjadi:
// Route::redirect('/', 'admin/login');

Route::get('filament/admin', function () {
    return view('welcome');
});
