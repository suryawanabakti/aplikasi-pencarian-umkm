@extends('public.layouts.app')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div clas="row">
                <div class="col-md-12 mb-2 d-flex justify-content-between">
                    <button class="btn fw-bold">
                        Form Tambah Lokasi UMKM
                    </button>
                    <a href="/lokasi-umkm" class="btn btn-primary">Kembali</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/lokasi-umkm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="data_umkm_id" class="form-label">Nama UMKM <span
                                            class="text-danger">*</span></label>
                                    <select name="data_umkm_id" id="data_umkm_id" class="form-select">
                                        @foreach ($dataUmkm as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_umkm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">Latitude <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="latitude" required>
                                </div>
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">Longitude <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="longitude" required>
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
