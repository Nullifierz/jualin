<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    @vite('resources/sass/app.scss')
    <title>Dashboard</title>

    <style>
        @media only screen and (max-width: 640px) {
            .swiper-wrapper {
                padding-left: calc(50% - 4vw);
            }

        }

        @media only screen and (max-width: 520px) {
            .swiper-wrapper {
                padding-left: calc(50% - 16vw);
            }
        }

        @media only screen and (max-width: 460px) {
            .swiper-wrapper {
                padding-left: calc(50% - 30vw);
            }
        }

        @media only screen and (max-width: 400px) {
            .swiper-wrapper {
                padding-left: 0;
            }
        }

    </style>
</head>
<body>

    <div class="base">
        <div class="d-flex flex-column align-items-center mt-3 text-center">
            <img src="{{ asset('frontend/logo.png') }}" alt="" class="w-25">
            <h1>Website Rekomendasi Tempat Berjualan Terbaik!</h1>
        </div>

        <div class="filter-container d-flex gap-3 justify-content-center">
            <select id="category-filter" class="filter-select">
                <option value="all">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                @endforeach
            </select>
            
            <select id="radius-filter" class="filter-select">
                <option value="0">Semua jarak</option>
                <option value="1">1 km</option>
                <option value="2">2 km</option>
                <option value="3">3 km</option>
                <option value="5">5 km</option>
            </select>
        </div>




        <div class="cards-container swiper mx-5" style="height: 36rem;">
            <div class="no-results-message alert alert-warning text-center" style="display: none;">
                <i class="fas fa-info-circle me-2"></i>
                Maaf, rekomendasi masih belum ada.
            </div>
            
            <div class="swiper-wrapper">
                @foreach($places as $place)
                    <div class="swiper-slide" 
                         data-id="{{ $place->id_recommendation }}"
                         data-lat="{{ $place->latitude }}"
                         data-lng="{{ $place->longitude }}"
                         data-category="{{ $place->categories->pluck('id_category')->implode(',') }}">
                         <div class="card" style="width: 18rem; height: 35rem;" data-lat="{{ $place->latitude }}" data-lng="{{ $place->longitude }}">
                            <img src="{{ asset('storage/' . $place->image) }}" class="card-img-top" alt="...">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $place->name }}</h5>

                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @foreach($place->categories as $category)
                                            <div class="badge bg-primary">
                                                {{ $category->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <p class="card-text"><span class="fw-bold">
                                        Alamat lengkap:</span> {{ $place->address }}

                                        </br> </br>
                                        <span class="fw-bold">Deskripsi:</span> {{ $place->description }}</p>
                                </div>

                                <div>
                                    <a href="#mappy" class="btn fw-bold" onclick="showDirections({{ $place->latitude }}, {{ $place->longitude }})">Lihat lokasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>
        

        <button id="scrollTopBtn" class="scroll-to-top-btn">
            <i class="fas fa-arrow-up"></i>
        </button>

        <div class="maps-container container mb-5">
            <div id="mappy" class="w-100"></div>
        </div>

        <footer>
            <p>&copy; 2025 Jualin. All rights reserved.</p>
        </footer>

    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=API_ANDA&callback=initMap"></script>
    @vite('public/frontend/script.js')
</body>
</html>


