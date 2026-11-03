<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PlaceRecommendation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pinggir Jalan'],
            ['name' => 'Pasar'],
            ['name' => 'Kampus'],
            ['name' => 'Kos-Kosan'],
            ['name' => 'Rumah Sakit'],
            ['name' => 'Sekolahan'],
            ['name' => 'Lapangan'],
            ['name' => 'Monumen'],
            ['name' => 'Taman'],
            ['name' => 'Hotel'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
        
        $placeRecommendations = [
            [
                'name' => 'Area Sekitar UNIKOM',
                'address' => 'Jl. Dipati Ukur No.112-116, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
                'description' => 'Sekitar UNIKOM sering menjadi tempat berkumpul mahasiswa, sehingga berpotensi sebagai lokasi strategis untuk berjualan.',
                'latitude' => '-6.887381',
                'longitude' => '107.615095',
                'categories' => ['Pinggir Jalan', 'Kampus'],
                'image' => null,
            ],
            [
                'name' => 'Simpang Dago',
                'address' => 'Lebak Gede, Coblong, Kota Bandung, Jawa Barat 40132',
                'description' => 'Simpang Dago adalah persimpangan yang menghubungkan beberapa jalan utama di Bandung dan merupakan area dengan aktivitas komersial yang tinggi, menjadikannya lokasi yang potensial untuk berjualan.',
                'latitude' => '-6.8852',
                'longitude' => '107.6138',
                'categories' => ['Pasar', 'Pinggir Jalan'],
                'image' => null,
            ],
            [
                'name' => 'Dipinggir Jalan Ir. H. Juanda',
                'address' => 'Jalan Ir. H. Juanda, Dago, Kota Bandung, Jawa Barat 40132',
                'description' => 'Jalan utama yang menghubungkan pusat kota ke Dago Atas ini lumayan ramai. Banyak wisatawan dan warga lokal yang lewat, jadi potensial banget buat jualan.',
                'latitude' => '-6.8718',
                'longitude' => '107.6190',
                'categories' => ['Pinggir Jalan'],
                'image' => null,
            ],
            [
                'name' => 'Jalan Tubagus Ismail Atas',
                'address' => 'Jalan Tubagus Ismail Atas, Coblong, Bandung',
                'description' => 'Akses menuju Dago Atas di Coblong dipenuhi kos-kosan dan kontrakan mahasiswa, lalu lintasnya ramai, jadi pas untuk berjualan.',
                'latitude' => '-6.8785',
                'longitude' => '107.6205',
                'categories' => ['Pinggir Jalan', 'Kos-Kosan'],
                'image' => null,
            ],
            [
                'name' => 'Pertigaan Sekeloa',
                'address' => 'Jl. Sekeloa 15-17, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
                'description' => 'Lokasi berjualan pedagang kaki lima di sekitar pertigaan sekeloa, lokasi ini cukup strategis karena target pembeli yang banyak, dari mulai kalangan penghuni kos sampai masyarakat sekitar.',
                'latitude' => '-6.889235',
                'longitude' => '107.617751',
                'categories' => ['Pinggir Jalan', 'Kos-Kosan'],
                'image' => null,
            ],
            [
                'name' => 'Dekat RSGM UNPAD',
                'address' => 'Jl. Sekeloa 15-17, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
                'description' => 'Lokasi berjualan pedagang kaki lima di dekat RSGM UNPAD, dengan target pembeli mahasiswa dan masyarakat sekitar, selain itu lokasi ini juga cukup strategis karena lokasinya yang berada di kawasan padat kos-kosan.',
                'latitude' => '-6.888708',
                'longitude' => '107.618851',
                'categories' => ['Rumah Sakit', 'Kos-Kosan'],
                'image' => null,
            ],
            [
                'name' => 'Dekat Indomaret Tubagus Ismail',
                'address' => 'Jl. Tubagus Ismail No.28, Sekeloa, Kecamatan Coblong, Kota Bandung, Jawa Barat 40134',
                'description' => 'Lokasi berjualan pedagang kaki lima di dekat Indomaret Tubagus Ismail, strategis karena berada di kawasan padat kos-kosan dan lalu lintas ramai.',
                'latitude' => '-6.885080',
                'longitude' => '107.618183',
                'categories' => ['Pinggir Jalan', 'Kos-Kosan'],
                'image' => null,
            ],
            [
                'name' => 'Sepanjang Jalan Cihampelas',
                'address' => 'Jl. Cihampelas 159, Cipaganti, Kecamatan Coblong, Kota Bandung, Jawa Barat 40131',
                'description' => 'Destinasi wisata dengan banyak pedagang kaki lima dan area pertokoan, target pembeli wisatawan lokal maupun luar kota.',
                'latitude' => '-6.893333',
                'longitude' => '107.614139',
                'categories' => ['Pinggir Jalan'],
                'image' => null,
            ],
            [
                'name' => 'Jalan Sastra (SD Cipaganti)',
                'address' => 'Jl. Sastra No.11, Cipaganti, Kecamatan Coblong, Kota Bandung, Jawa Barat 40131',
                'description' => 'Area makanan dengan berbagai pedagang kaki lima, target pembeli pegawai kantor dan anak SD.',
                'latitude' => '-6.894611',
                'longitude' => '107.602583',
                'categories' => ['Pinggir Jalan', 'Sekolahan'],
                'image' => null,
            ],
            [
                'name' => 'Jl. Bapa Husen Depan RS Advent',
                'address' => 'Jl. Bapa Husen No.9, Kp. Parung Jambu, Cipaganti, Kecamatan Coblong, Kota Bandung, Jawa Barat 40131',
                'description' => 'Lokasi strategis dekat rumah sakit dengan penjual makanan berat harga terjangkau.',
                'latitude' => '-6.891528',
                'longitude' => '107.603222',
                'categories' => ['Rumah Sakit'],
                'image' => null,
            ],
            [
                'name' => 'Jl. Gelap Nyawang sampai Jl. Skanda',
                'address' => 'Jl. Gelap Nyawang sampai Jl. Skanda, Lebak Siliwangi',
                'description' => 'Area dekat gerbang utama ITB dengan banyak pedagang kaki lima.',
                'latitude' => '-6.8940405',
                'longitude' => '107.6099927',
                'categories' => ['Kampus'],
                'image' => null,
            ],
            [
                'name' => 'Monumen Perjuangan (Monju)',
                'address' => '4J39+6FJ, Lebak Gede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
                'description' => 'Lokasi ramai pengunjung dengan pasar dadakan setiap Minggu pagi hingga siang.',
                'latitude' => '-6.895977',
                'longitude' => '107.618589',
                'categories' => ['Monumen'],
                'image' => null,
            ],
            
        ];

        foreach ($placeRecommendations as $placeData) {
            $categories = Category::whereIn('name', $placeData['categories'])
                            ->pluck('id_category')
                            ->toArray();
            unset($placeData['categories']);
            
            $place = PlaceRecommendation::create($placeData);
            $place->categories()->attach($categories);
        }
    }
}
