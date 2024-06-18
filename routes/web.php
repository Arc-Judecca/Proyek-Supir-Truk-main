<?php

use App\Http\Controllers\API\SupirController;
use App\Http\Controllers\API\NotaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('supir.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/supir', [SupirController::class, 'index'])->name('supir.index');
    Route::get('/supir/create', [SupirController::class, 'create'])->name('supir.create');
    Route::post('/supir', [SupirController::class,'store'])->name('supir.store');
    Route::get('/supir/{id}/edit', [SupirController::class, 'edit'])->name('supir.edit');
    Route::put('/supir/{id}', [SupirController::class, 'update'])->name('supir.update');
    Route::delete('/supir/{id}', [SupirController::class, 'destroy'])->name('supir.destroy');
    Route::get('/nota', [NotaController::class, 'showNota'])->name('supir.nota');
    Route::get('/upload-nota', [NotaController::class, 'uploadNota'])->name('upload.nota');
    Route::post('/nota/store', [NotaController::class, 'storeNota'])->name('store.nota');
    Route::get('/nota/{id}/edit', [NotaController::class, 'edit'])->name('edit.nota');
    Route::put('/nota/{id}', [NotaController::class, 'update'])->name('update.nota');
    Route::delete('/nota/{id}', [NotaController::class, 'destroy'])->name('delete.nota');
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('/{any}', function () {
    return view('404');
})->where('any', '.*');
