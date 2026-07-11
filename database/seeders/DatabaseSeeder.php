<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Artist;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@jepara.test',
            'password' => Hash::make('password')
        ]);

        $artist1 = Artist::create([
            'name' => 'Bapak Sudarmo',
            'bio' => 'Seniman ukir master dengan pengalaman lebih dari 40 tahun dalam teknik pahatan relief 3 Dimensi tradisional Jepara. Fokus pada motif epik kuno dan flora Nusantara.',
            'profile_photo_path' => null,
            'portfolio_images' => [],
        ]);

        $artist2 = Artist::create([
            'name' => 'Karya Jati Studio',
            'bio' => 'Studio ukir modern yang menggabungkan presisi mesin CNC tingkat lanjut dengan sentuhan pahatan tangan (Hand-Carved) final untuk detail luar biasa.',
            'profile_photo_path' => null,
            'portfolio_images' => [],
        ]);

        Product::create([
            'artist_id' => $artist1->id,
            'title' => 'Relief Epik Ramayana Penuh 120cm',
            'description' => 'Ukiran mahakarya yang menceritakan pertempuran epik. Asli pahatan tangan tanpa mesin. Detail luar biasa pada setiap tokoh wayang dengan kayu Jati Perhutani A.',
            'price' => 15000000.00,
            'currency' => 'IDR',
            'stock' => 1,
            'production_method' => 'Hand-Carved',
            'svlk_certificate_number' => 'SVLK-JPR-2023-0941',
            'svlk_issue_date' => '2023-11-15',
            'model_3d_path' => 'https://modelviewer.dev/shared-assets/models/Astronaut.glb',
            'images' => ['relief-ramayana.png'],
        ]);

        Product::create([
            'artist_id' => $artist2->id,
            'title' => 'Panel Ornamen Bunga Teratai Hias',
            'description' => 'Dekorasi dinding elegan desain bunga Teratai. Dibentuk dengan mesin CNC presisi tinggi dan diselesaikan dengan alat pahat tangan untuk kehalusan absolut.',
            'price' => 3500000.00,
            'currency' => 'IDR',
            'stock' => 5,
            'production_method' => 'CNC-Assisted',
            'svlk_certificate_number' => 'SVLK-JPR-2024-1102',
            'svlk_issue_date' => '2024-02-10',
            'model_3d_path' => 'https://modelviewer.dev/shared-assets/models/NeilArmstrong.glb',
            'images' => ['relief-bunga.png'],
        ]);
        
        Product::create([
            'artist_id' => $artist1->id,
            'title' => 'Relief Kaligrafi Jati Kuno Jepara',
            'description' => 'Pahatan kaligrafi 3D syahdu pada kayu Jati Perhutani yang kokoh. Sangat autentik dan memiliki nilai spiritual mendalam.',
            'price' => 8500000.00,
            'currency' => 'IDR',
            'stock' => 2,
            'production_method' => 'Hand-Carved',
            'svlk_certificate_number' => 'SVLK-JPR-2023-0941',
            'svlk_issue_date' => '2023-11-15',
            'model_3d_path' => null,
            'images' => ['relief-kaligrafi.png'],
        ]);
    }
}
