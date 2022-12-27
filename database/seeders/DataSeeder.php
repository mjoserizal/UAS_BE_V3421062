<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Data62;
class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Data62::create([
            'id'=>'1',
            'id_user' => '1',
            'alamat' => 'Tulungagung',
            'tempat_lahir' => 'Tulungagung',
            'tanggal_lahir' => '2002-09-04',
            'id_agama' => 1,
            'foto_ktp' => 'admin.jpg',
            'umur' => '20',
        ]);
    }
}
