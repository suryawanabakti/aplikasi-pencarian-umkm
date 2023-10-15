@extends('public.layouts.app')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div clas="row">
                <div class="col-md-12 mb-2 d-flex justify-content-between">
                    <button class="btn fw-bold">
                        Form Tambah Data UMKM
                    </button>
                    <a href="/data-umkm" class="btn btn-primary">Kembali</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/data-umkm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="namaUmkm" class="form-label">Nama UMKM <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="namaUmkm" name="nama_umkm" class="form-control"
                                        placeholder="Masukkan Nama UMKM..." required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsiUmkm" class="form-label">Deskripsi UMKM <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="deskripsiUmkm" name="deskripsi_umkm" class="form-control"
                                        placeholder="Masukkan Deskripsi UMKM..." required>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Logo <span class="text-danger">*</span></label>
                                    <input type="file" id="gambar" name="gambar" class="form-control">
                                </div>

                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@push('js')
@endpush
