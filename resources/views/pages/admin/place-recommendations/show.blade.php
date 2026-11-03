@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Detail Tempat Rekomendasi</h6>
            </div>
            <div class="card-body">
                <div class="row d-flex flex-column align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $placeRecommendation->image) }}" alt="Gambar Tempat Rekomendasi" class="img-fluid">
                    </div>

                    <div class="col-md-10">
                        <table class="table table-borderless">
                            <tr>
                                <td>Nama Tempat</td>
                                <td>:</td>
                                <td>{{ $placeRecommendation->name }}</td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $placeRecommendation->address }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{ $placeRecommendation->description }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>
                                    @foreach($placeRecommendation->categories as $category)
                                        <span class="badge bg-primary text-white">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-10 mt-4">
                        <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=API_ANDA&callback=initMap">
    </script>
    <script>
        function initMap() {
            const latitude = {{ $placeRecommendation->latitude }};
            const longitude = {{ $placeRecommendation->longitude }};
            
            const placeLocation = new google.maps.LatLng(latitude, longitude);
            
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: placeLocation,
                mapTypeId: "terrain",
            });

            new google.maps.Marker({
                position: placeLocation,
                map: map,
                title: "{{ $placeRecommendation->name }}",
            });
        }
    </script>
@endsection