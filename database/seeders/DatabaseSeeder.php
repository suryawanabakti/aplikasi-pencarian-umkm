<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataUmkm;
use App\Models\LokasiUmkm;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => bcrypt('qwerty123')
        ]);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);
        $user->assignRole('admin');


        $data1 = DataUmkm::create([
            'nama_umkm' => 'Daeng Burger',
            'deskripsi_umkm' => 'UMKM yang menjual burger '
        ]);

        LokasiUmkm::create([
            'data_umkm_id' => $data1->id,
            'latitude' => '-5.132016',
            'longitude' => '119.500323'
        ]);


        $data2 = DataUmkm::create([
            'nama_umkm' => 'Laundry',
            'deskripsi_umkm' => 'Laundry terbaik di kota makassar 😲'
        ]);

        LokasiUmkm::create([
            'data_umkm_id' => $data2->id,
            'latitude' => '-5.132678',
            'longitude' => '119.498102'
        ]);
    }
}
