<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Muhammad Fikri Hasani Sururi',
                'email' => 'fikrihasani471@gmail.com',
                'password' => bcrypt('fikri123456789*'),
                'role' => 1,
            ],
        ];

        User::insert($users);

        $users = [
            [
                'title' => 'Fikrithings',
                'subtitle' => 'Tingkatkan pengetahuan dan kecakapan di berbagai bidang dengan metode belajar mandiri, langkah demi langkah.',
                'image_banner_left' => 'left.png',
                'image_banner_right' => 'right.png',
                'image' => 'fikri.jpg',
                'name' => 'M. Fikri Hasani Sururi',
                'description' => '
                    Banyak yang bilang generasi muda hari ini dimanjakan informasi dan pengetahuan yang begitu mudah digapai. Betul bahwa pertemuan pemikiran dengan mudah tergelar di mesin pencarian. Pendidikan menjamur dengan ragam layanan dan standar. Ilmu kelas wahid dari berbagai belahan bumi dengan mudahnya diakses dalam sekali klik.

                    Sayangnya, belajar di rimba maya tak sepenuhnya mudah. Platform elearning yang menjamur hadir dengan harga tak murah. Konten pendidikan menjadi komoditas beli-putus, tak peduli apakah ilmu yang didapat benar-benar berharga atau hanya transaksi yang percuma.

                    Nural adalah tempat berkumpulnya akademisi, programmer, peneliti, ilmuwan data, dan seniman yang percaya bahwa pengetahuan adalah hak mendasar yang seharusnya terselenggara dengan akses terbuka.
                ',
            ],
        ];

        CompanyProfile::insert($users);
    }
}
