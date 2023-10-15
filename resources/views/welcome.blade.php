@extends('public.layouts.app')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="#" id="formSearch">
                                <div class="mb-3">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="term" name="term"
                                            placeholder="Cari UMKM ... " onkeypress="refreshWhenEmpty(this)">
                                        <button class="btn btn-icon" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-search" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                <path d="M21 21l-6 -6"></path>
                                            </svg>
                                        </button>
                                        <a class="btn btn-icon" href="">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-reload" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747">
                                                </path>
                                                <path d="M20 4v5h-5"></path>
                                            </svg>
                                        </a>


                                    </div>
                                </div>
                            </form>

                            <div class="row" id="datas" style="overflow: scroll; height:400px;">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3"><b>Loading ...</b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="text" id="latitude" hidden>
                        <input type="text" id="longitude" hidden>
                        <div class="col-md-8">
                            <div id="map" style="height: 400px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        getLocation()

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {

            }
        }



        $("form").on("submit", async function(e) {
            e.preventDefault()

            await $.ajax({
                url: '/api/get-location',
                type: 'GET',
                data: {
                    latitude: $('#latitude').val(),
                    longitude: $('#longitude').val(),
                    term: $('#term').val()
                },
                success: function(res) {
                    var html = ``
                    console.log(res)
                    res.forEach(element => {
                        if (element.data) {
                            var star = 0
                            element.data.umkm.penilaian.forEach(element2 => {
                                star += element2.star
                            });

                            html += `<div class="col-md-12 mt-2"><div class="card">
                                        <div class="card-body">
                        <div class="mb-3"><b>${element.data?.umkm.nama_umkm}</b></div>
                                    <p>${element.data?.umkm.deskripsi_umkm.substring(0, 100)}</p>
                                    <small>Jarak: ${Math.round(element.distance * 100) / 100} Km.</small>
                                    <br />
                                    <small>Star: ${star} Km.</small>
                                    <br />
                                    <a class="btn btn-icon mt-3" href="http://maps.google.com/?q=${element.data.latitude},${element.data.longitude}" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M14.916 11.707a3 3 0 1 0 -2.916 2.293"></path>
   <path d="M11.991 21.485a1.994 1.994 0 0 1 -1.404 -.585l-4.244 -4.243a8 8 0 1 1 13.651 -5.351"></path>
   <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
   <path d="M20.2 20.2l1.8 1.8"></path>
</svg></a>
<a class="btn btn-icon mt-3" href="/umkm/${element.data.id}" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
   <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
</svg></a>
                                    </div></div> </div>`
                        }



                    });
                    if (html == '') {
                        html =
                            '<div class="col-md-12 mt-2"> <div class="card"> <div class="card-body"><b>Maaf,, Data Tidak Ditemukan 🥲</b></div> </div> </div>'
                    }
                    $('#datas').html(html)
                },
            })
        });
        async function showPosition(position) {
            $('#latitude').val(position.coords.latitude)
            $('#longitude').val(position.coords.longitude)
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            marker.bindPopup("<a href=''>Lokasiku</a> <b> </b>", {
                permanent: true,
                opacity: 0.8
            })

            await $.ajax({
                url: '/api/get-location',
                type: 'GET',
                data: {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                },
                success: function(res) {
                    var html = ``
                    console.log(res)
                    res.forEach(element => {

                        var star = 0
                        element.data.umkm.penilaian.forEach(element2 => {
                            star += element2.star
                        });
                        html += `<div class="col-md-12 mt-2"><div class="card">
                                        <div class="card-body">
                        <div class="mb-3"><b>${element.data.umkm.nama_umkm}</b></div>
                                    <p>${element.data?.umkm.deskripsi_umkm.substring(0, 100)}</p>
                                    <small>Jarak: ${Math.round(element.distance * 100) / 100} Km.</small>
                                    <br />
                                    <small>Star ${star}</small>
                                    <br />
                                    <a class="btn btn-icon mt-3" href="http://maps.google.com/?q=${element.data.latitude},${element.data.longitude}" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14.916 11.707a3 3 0 1 0 -2.916 2.293"></path>
                                        <path d="M11.991 21.485a1.994 1.994 0 0 1 -1.404 -.585l-4.244 -4.243a8 8 0 1 1 13.651 -5.351"></path>
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                        <path d="M20.2 20.2l1.8 1.8"></path>
                                        </svg>
                                    </a> 
                                    <a class="btn btn-icon mt-3" href="/umkm/${element.data.id}" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
   <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
</svg></a>
                                    </div></div></div>`
                    });

                    $('#datas').html(html)
                },
            })

            @foreach ($lokasiUmkm as $lokasi)
                var marker = L.marker(['{{ $lokasi->latitude }}', '{{ $lokasi->longitude }}']).addTo(map);
                marker.bindPopup("<a href='javascript:void(0)'>{{ $lokasi->umkm->nama_umkm }}</a> <b> </b>", {
                    permanent: true,
                    opacity: 0.8
                })
            @endforeach

        }
    </script>
@endpush
