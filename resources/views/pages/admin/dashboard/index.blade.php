@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Rekomendasi Card -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Rekomendasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $places->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Total Kategori Card -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body"> 
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->count() }}</div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>
    </div>
</div>

<!-- Script for Map -->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=API_ANDA&callback=initMap">
</script>
<script>
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: { lat: -6.8903, lng: 107.6190 },
    });

    const places = @json($places);

    places.forEach(place => {
        const position = new google.maps.LatLng(parseFloat(place.latitude), parseFloat(place.longitude));
        
        const marker = new google.maps.Marker({
            position: position,
            map: map,
            title: place.name
        });

        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div class="d-flex flex-column align-items-center" style="color: #000;">
                    ${place.image ? `<img src="${place.image}" style="max-width:180px; height:auto; margin-top:5px">` : ''}
                    <h3 class="text-center" style="font-size:16px; margin: 5px 0">${place.name}</h3>
                    <p style="margin:0; font-size:12px">${place.address}</p>
                    <p style="width:60%; margin:5px 0; font-size:12px" class="text-justify">${place.description}</p>
                </div>
            `
        });

        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });
    });
}
</script>
@endsection


