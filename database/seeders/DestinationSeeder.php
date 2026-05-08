<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Pantai Pink Lombok',
                'region' => 'Nusa Tenggara Barat',
                'description' => 'Pantai berpasir merah muda dengan air laut jernih, cocok untuk snorkeling dan menikmati panorama pesisir tropis.',
                'image' => 'pantai-pink.png',
                'ticket_price' => 25000,
            ],
            [
                'name' => 'Kawah Ijen',
                'region' => 'Jawa Timur',
                'description' => 'Kawasan kawah vulkanik dengan fenomena blue fire, danau asam berwarna toska, serta jalur pendakian yang populer.',
                'image' => 'kawah-ijen.png',
                'ticket_price' => 15000,
            ],
            [
                'name' => 'Raja Ampat',
                'region' => 'Papua Barat Daya',
                'description' => 'Surga bahari Indonesia dengan pulau karst, air laut biru, dan keanekaragaman bawah laut kelas dunia.',
                'image' => 'raja-ampat.png',
                'ticket_price' => 500000,
            ],
            [
                'name' => 'Gunung Bromo',
                'region' => 'Jawa Timur',
                'description' => 'Destinasi pegunungan dengan lautan pasir, sunrise ikonik, dan lanskap vulkanik yang dramatis.',
                'image' => 'gunung-bromo.png',
                'ticket_price' => 29000,
            ],
            [
                'name' => 'Danau Toba',
                'region' => 'Sumatera Utara',
                'description' => 'Danau vulkanik besar dengan Pulau Samosir di tengahnya, menyajikan alam dan budaya Batak yang kuat.',
                'image' => 'danau-toba.png',
                'ticket_price' => 15000,
            ],
            [
                'name' => 'Taman Nasional Komodo',
                'region' => 'Nusa Tenggara Timur',
                'description' => 'Kawasan konservasi komodo dengan pulau eksotis, trekking savana, pantai, dan spot diving yang menawan.',
                'image' => 'komodo.png',
                'ticket_price' => 150000,
            ],
            [
                'name' => 'Curug Cikaso',
                'region' => 'Jawa Barat',
                'description' => 'Air terjun bertingkat dengan kolam alami berwarna hijau kebiruan yang sejuk dan fotogenik.',
                'image' => 'curug-cikaso.png',
                'ticket_price' => 10000,
            ],
            [
                'name' => 'Nusa Penida',
                'region' => 'Bali',
                'description' => 'Pulau dengan tebing laut megah, pantai tersembunyi, dan titik pandang populer seperti Kelingking Beach.',
                'image' => 'nusa-penida.png',
                'ticket_price' => 25000,
            ],
            [
                'name' => 'Dataran Tinggi Dieng',
                'region' => 'Jawa Tengah',
                'description' => 'Kawasan dataran tinggi dengan telaga warna, candi, kawah, dan udara sejuk khas pegunungan.',
                'image' => 'dieng.png',
                'ticket_price' => 20000,
            ],
            [
                'name' => 'Gunung Rinjani',
                'region' => 'Nusa Tenggara Barat',
                'description' => 'Gunung megah dengan jalur pendakian menantang, Danau Segara Anak, dan panorama alam yang luas.',
                'image' => 'rinjani.png',
                'ticket_price' => 35000,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['name' => $destination['name']],
                $destination
            );
        }
    }
}
