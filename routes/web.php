<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AracController;
use App\Http\Controllers\YorumController;
use App\Http\Controllers\BakimController;

Route::get('/', function () {
    return redirect('/araclar');
});

// Araçlar Modülü
Route::get('/araclar', [AracController::class, 'index']);
Route::post('/araclar/ekle', [AracController::class, 'store']);
Route::put('/araclar/guncelle/{id}', [AracController::class, 'update']);
Route::delete('/araclar/sil/{id}', [AracController::class, 'destroy']);

// Yorumlar Modülü
Route::get('/yorumlar', [YorumController::class, 'index']);
Route::post('/yorumlar/ekle', [YorumController::class, 'store']);
Route::put('/yorumlar/guncelle/{id}', [YorumController::class, 'update']);
Route::delete('/yorumlar/sil/{id}', [YorumController::class, 'destroy']);

// Bakım & Servis Modülü
Route::get('/bakimlar', [BakimController::class, 'index']);
Route::post('/bakimlar/ekle', [BakimController::class, 'store']);
Route::put('/bakimlar/guncelle/{id}', [BakimController::class, 'update']);
Route::delete('/bakimlar/sil/{id}', [BakimController::class, 'destroy']);