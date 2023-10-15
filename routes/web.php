<?php

use App\Http\Controllers\DataUmkmController;
use App\Http\Controllers\LokasiUmkmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicUmkmController;
use App\Models\DataUmkm;
use App\Models\LokasiUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function (Request $request) {
    $lokasiUmkm = LokasiUmkm::with('umkm');

    $lokasiUmkm = $lokasiUmkm->with('umkm', 'umkm.penilaian')->get();
    return view('welcome', compact('lokasiUmkm'));
});

Route::get('/umkm/{lokasiUmkm}', [PublicUmkmController::class, 'index']);
Route::post('/give-star/{dataUmkm}', [PublicUmkmController::class, 'giveStar']);

Route::get('/test', function (Request $request) {
    return json_decode(Http::get("http://starter-app-blade.test/word/?word=$request->word"));
});

Route::get('/dashboard', function () {
    $countUmkm = DataUmkm::count();
    $countLokasiUmkm = LokasiUmkm::count();

    return view('dashboard', compact('countUmkm', 'countLokasiUmkm'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/data-umkm', [DataUmkmController::class, 'index']);
Route::post('/data-umkm', [DataUmkmController::class, 'store']);
Route::get('/data-umkm/create', [DataUmkmController::class, 'create']);
Route::get('/data-umkm/{dataUmkm}/delete', [DataUmkmController::class, 'destroy'])->name('data-umkm.destroy');

Route::get('/lokasi-umkm', [LokasiUmkmController::class, 'index']);
Route::post('/lokasi-umkm', [LokasiUmkmController::class, 'store']);
Route::get('/lokasi-umkm/create', [LokasiUmkmController::class, 'create']);
Route::get('/lokasi-umkm/{lokasiUmkm}/delete', [LokasiUmkmController::class, 'destroy']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
