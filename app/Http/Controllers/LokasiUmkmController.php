<?php

namespace App\Http\Controllers;

use App\Models\DataUmkm;
use App\Models\LokasiUmkm;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LokasiUmkmController extends Controller
{
    public function index()
    {
        $lokasiUmkm = LokasiUmkm::orderBy('created_at', 'desc')->get();
        return view('lokasi-umkm.index', compact('lokasiUmkm'));
    }

    public function create()
    {
        $dataUmkm = DataUmkm::orderBy('created_at', 'desc')->get();
        return view('lokasi-umkm.create', compact('dataUmkm'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data_umkm_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        LokasiUmkm::create($validatedData);
        Alert::success("Berhasil Tambah Lokasi UMKM");
        return redirect('/lokasi-umkm');
    }
    public function destroy(LokasiUmkm $lokasiUmkm)
    {
        $lokasiUmkm->delete();
        Alert::success("Berhasil Hapus");
        return back();
    }
}
