@extends('public.layouts.app')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <a href="/lokasi-umkm/create" class="btn btn-primary mb-2">Tambah Lokasi UMKM</a>
                </div>


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Nama UMKM</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lokasiUmkm as $lokasi)
                                            <tr>
                                                <td>{{ $lokasi->umkm->nama_umkm }}</td>
                                                <td>{{ $lokasi->latitude }}</td>
                                                <td>{{ $lokasi->longitude }}</td>
                                                <td>
                                                    <a href="/lokasi-umkm/{{ $lokasi->id }}/delete"
                                                        class="btn btn-danger btn-sm btn-icon"
                                                        onclick="return confirm('Apakah kamu yakin menghapus lokasi ini?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-trash" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#myTable').DataTable()
    </script>
@endpush
