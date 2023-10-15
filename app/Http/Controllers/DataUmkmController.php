<?php

namespace App\Http\Controllers;

use App\Models\DataUmkm;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataUmkmController extends Controller
{
    public function index()
    {
        $dataUmkm = DataUmkm::orderBy('created_at', 'desc')->get();
        return view('data-umkm.index', compact('dataUmkm'));
    }

    public function create()
    {
        return view('data-umkm.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_umkm' => 'required',
            'deskripsi_umkm' => 'required'
        ]);

        if ($request->gambar) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-umkm');
        }

        DataUmkm::create($validatedData);

        return redirect('/data-umkm');
    }

    public function update(Request $request, DataUmkm $dataUmkm)
    {
        $validatedData = $request->validate([
            'nama_umkm' => 'required',
            'deskripsi' => 'required'
        ]);

        $dataUmkm->update($validatedData);

        return back();
    }

    public function destroy(DataUmkm $dataUmkm)
    {
        $dataUmkm->delete();
        Alert::success("Berhasil Hapus");
        return back();
    }
}
