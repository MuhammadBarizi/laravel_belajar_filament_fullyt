<?php

use Illuminate\Support\Facades\Route;

// Redirect root ke admin dashboard
Route::redirect('/', 'admin');

// Jika Anda ingin ke login langsung, ganti baris di atas menjadi:
// Route::redirect('/', 'admin/login');

Route::get('filament/admin', function () {
    return view('welcome');
});

// Export routes for PDF downloads (used by Filament table bulk actions)
Route::get('exports/barang/pdf', [\App\Http\Controllers\ExportController::class, 'exportBarangPdf'])->name('exports.barang.pdf');
Route::get('exports/customer/pdf', [\App\Http\Controllers\ExportController::class, 'exportCustomerPdf'])->name('exports.customer.pdf');
Route::get('exports/penjualan/pdf', [\App\Http\Controllers\ExportController::class, 'exportPenjualanPdf'])->name('exports.penjualan.pdf');
Route::get('exports/faktur/pdf', [\App\Http\Controllers\ExportController::class, 'exportFakturPdf'])->name('exports.faktur.pdf');
