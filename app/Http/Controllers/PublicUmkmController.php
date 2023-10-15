<?php

namespace App\Http\Controllers;

use App\Models\DataUmkm;
use App\Models\LokasiUmkm;
use App\Models\PenilaianUmkm;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PublicUmkmController extends Controller
{
    public function index(LokasiUmkm $lokasiUmkm)
    {
        $penilaianUmkm = PenilaianUmkm::where('data_umkm_id', $lokasiUmkm->data_umkm_id)->sum('star');
        return view('detail-umkm', compact('lokasiUmkm', 'penilaianUmkm'));
    }

    public function giveStar(Request $request, DataUmkm $dataUmkm)
    {
        $valData = $request->validate([
            'star'  => 'required|numeric|min:1|max:5'
        ]);
        $valData['user_id'] = auth()->id();
        $valData['data_umkm_id'] = $dataUmkm->id;
        $penilaian = PenilaianUmkm::where('user_id', auth()->id())->where('data_umkm_id', $dataUmkm->id)->first();
        if (empty($penilaian)) {
            Alert::success("Berhasil Tambah Penilaian");
            PenilaianUmkm::create($valData);
        } else {
            Alert::success("Berhasil Update Penilaian dari $penilaian->star ⭐ jadi $request->star ⭐");
            $penilaian->update($valData);
        }


        return back();
    }
}
