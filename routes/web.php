<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
// Route::get('/form-transaksi', [TransaksiController::class, 'showForm'])->name('form-transaksi');

Route::get('/form-transaksi', function () {
    return view('form-transaksi');
});
