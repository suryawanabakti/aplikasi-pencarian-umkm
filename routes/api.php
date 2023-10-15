<?php

use App\Models\LokasiUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-location', function (Request $request) {
    $latitude = $request->latitude;
    $longtitude =  $request->longitude;

    $showResult = DB::table("lokasi_umkm")
        ->select(
            "lokasi_umkm.id",
            DB::raw("6371 * acos(cos(radians(" . $latitude . ")) 
                * cos(radians(lokasi_umkm.latitude)) 
                * cos(radians(lokasi_umkm.longitude) - radians(" . $longtitude . ")) 
                + sin(radians(" . $latitude . ")) 
                * sin(radians(lokasi_umkm.latitude))) AS distance")
        )
        ->groupBy("lokasi_umkm.id")
        ->orderBy('distance', 'asc');

    $showResult = $showResult->get();

    foreach ($showResult as $result) {
        $lokasiUmkm = LokasiUmkm::where('id', $result->id);
        if ($request->term) {
            $lokasiUmkm->whereHas('umkm', function ($query) use ($request) {
                $query->where('nama_umkm', 'like', '%' . $request->term . '%');
            });
        }
        $nearestLocation[] = [
            "data" => $lokasiUmkm->with('umkm', 'umkm.penilaian')->first(),
            "distance" => $result->distance,
            "term" => $request->term ?? null
        ];
    }

    return $nearestLocation;
});
