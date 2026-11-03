const swiper = new Swiper('.swiper', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        350: {
            slidesPerView: 1,
            spaceBetween: 30,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 20,

        },
        824: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    }
});

document.getElementById('category-filter').addEventListener('change', function() {
    const selectedCategory = this.value;
    const slides = document.querySelectorAll('.swiper-slide');
    
    
    slides.forEach(slide => {
        const categories = slide.dataset.category.split(',').filter(Boolean); // Pastikan tidak ada nilai kosong
        const isMatch = selectedCategory === 'all' || categories.some(cat => cat === selectedCategory.toString()); // Cek apakah salah satu kategori match
        
        slide.style.display = isMatch ? 'flex' : 'none';
        slide.style.width = 'auto'; // Tambahkan ini untuk maintain layout
    });

    swiper.update();
    swiper.slideTo(0);
});


let map, userMarker, directionsRenderer, directionsService;
let places = [];
const markers = [];
let currentDestinationMarker = null; // Tambahkan variabel global

function initMap() {
    directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });
    directionsService = new google.maps.DirectionsService();
    const mapOptions = {
        zoom: 13,
        mapTypeControl: false
    };
    
    map = new google.maps.Map(document.getElementById('mappy'), mapOptions);
    directionsRenderer.setMap(map);
    
    // Handle user location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const userPos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                
                // User marker dengan info window
                userMarker = new google.maps.Marker({
                    position: userPos,
                    map: map,
                    title: 'Lokasi Anda',
                });
                
                const infoWindow = new google.maps.InfoWindow({
                    content: '<strong>Kamu Berada Disini</strong>'
                });
                infoWindow.open(map, userMarker);
                map.setCenter(userPos);
                
                // Ambil data places dan init markers
                initPlaces();
            },
            error => {
                if (error.code === 1) {
                    alert('Aktifkan GPS untuk fitur lengkap');
                }
                initPlaces();
            }
        );
    } else {
        initPlaces();
    }
}

function initPlaces() {
    // Hapus pembuatan marker otomatis
    document.querySelectorAll('.swiper-slide').forEach(slide => {
        const place = {
            id: slide.dataset.id,
            name: slide.querySelector('.card-title').innerText,
            lat: parseFloat(slide.dataset.lat),
            lng: parseFloat(slide.dataset.lng),
            address: slide.querySelector('.card-text').innerText.split('Alamat lengkap:')[1].split('Deskripsi:')[0].trim(),
            image: slide.querySelector('.card-img-top').src,
            element: slide,
            marker: null // Tambahkan properti marker

        };
        places.push(place);
    });
}

function calculateDistance(lat1, lng1, lat2, lng2) {
    const R = 6371; // Radius bumi dalam km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLng = (lng2 - lng1) * Math.PI / 180;
    const a = 
        Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(lat1 * Math.PI / 180) * 
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLng/2) * Math.sin(dLng/2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    return R * c;
}

function filterPlaces() {
    const selectedRadius = parseInt(document.getElementById('radius-filter').value);
    const userPos = userMarker ? userMarker.getPosition() : null;
    
    // Iterasi melalui semua places
    places.forEach(place => {
        let shouldShow = true;
        
        if (userPos && selectedRadius > 0) {
            const distance = calculateDistance(
                userPos.lat(), 
                userPos.lng(),
                place.lat,
                place.lng
            );
            shouldShow = distance <= selectedRadius;
        }
        
        // Update tampilan card
        place.element.style.display = shouldShow ? 'flex' : 'none';
        place.element.style.opacity = shouldShow ? '1' : '0';
        place.element.style.transition = 'all 0.3s ease';
    });

    // Cek apakah ada hasil
    const visibleSlides = document.querySelectorAll('.swiper-slide[style*="display: flex"]');
    const noResultsMessage = document.querySelector('.no-results-message');
    
    if (visibleSlides.length === 0) {
        noResultsMessage.style.display = 'block';
        map.setZoom(12); // Zoom out jika tidak ada hasil
    } else {
        noResultsMessage.style.display = 'none';
    }

    // Perbarui swiper dengan cara yang lebih reliable
    setTimeout(() => {
        swiper.update();
        swiper.slideTo(0);
        swiper.params.spaceBetween = 30; // Reset spacing
    }, 100);
}

// Event listeners
document.getElementById('radius-filter').addEventListener('change', filterPlaces);

// Fungsi untuk menampilkan marker tempat
function showPlaceMarker(lat, lng) {
    // Hapus marker tujuan sebelumnya
    if(currentDestinationMarker) {
        currentDestinationMarker.setMap(null);
    }

    const place = places.find(p => p.lat === lat && p.lng === lng);
    
    // Hitung jarak
    const userPos = userMarker ? userMarker.getPosition() : null;
    const distance = userPos ? 
        calculateDistance(
            userPos.lat(),
            userPos.lng(),
            lat,
            lng
        ).toFixed(1) + ' km' : 
        'Jarak: Aktifkan GPS untuk melihat';

    // Buat marker baru
    currentDestinationMarker = new google.maps.Marker({
        position: { lat, lng },
        map: map,
        title: place.name,
    });

    // Info window untuk marker
    const infoWindow = new google.maps.InfoWindow({
        content: `
            <div class="map-info-window d-flex flex-column align-items-center">
                <img src="${place.image}" alt="${place.name}" class="img-fluid mb-2 w-50">
                <div class="text-center">
                    <h6 >${place.name}</h6>
                    <p>${place.address}</p>
                    <p class="mb-2"><strong>Jarak:</strong> ${distance}</p>

                </div>
                <button 
                    class="btn btn-sm btn-primary get-directions-btn"
                    data-lat="${lat}"
                    data-lng="${lng}">
                    <i class="fas fa-route me-2"></i>Arahkan

                </button>
            </img>
        `
    });

    infoWindow.addListener('domready', () => {
        document.querySelector('.get-directions-btn').addEventListener('click', () => {
            if (!userMarker) {
                alert('Lokasi Anda tidak terdeteksi. Pastikan GPS aktif!');
                return;
            }
            
            const request = {
                origin: userMarker.getPosition(),
                destination: new google.maps.LatLng(lat, lng),
                travelMode: 'DRIVING',
                provideRouteAlternatives: true
            };

            directionsService.route(request, (result, status) => {
                if (status === 'OK') {
                    // Sembunyikan semua marker kecuali user marker
                    markers.forEach(marker => marker.setMap(null));
                    
                    directionsRenderer.setDirections(result);
                } else {
                    alert('Gagal menampilkan rute: ' + status);
                }
            });
        });
    });
    
    // Buka info window otomatis
    infoWindow.open(map, currentDestinationMarker);
    map.panTo(currentDestinationMarker.getPosition());
}

// Update event listener untuk card
document.querySelectorAll('.swiper-slide .card').forEach(card => {
    card.addEventListener('click', function() {
        const lat = parseFloat(this.dataset.lat);
        const lng = parseFloat(this.dataset.lng);
        showPlaceMarker(lat, lng);
    });
});

initMap();``