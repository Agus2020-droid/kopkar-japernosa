<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,1000) as $index)
        {
            DB::table('anggota')->insert([
                "nik_anggota"=>$faker->nik_anggota,
                "nama_anggota"=>$faker->nama_anggota,
                "tempat_lahir"=>$faker->tempat_lahir,
                "tgl_lahir"=>$faker->tgl_lahir,
                "status"=>$faker->status,
                "alamat_anggota"=>$faker->alamat_anggota,
                "telp"=>$faker->telp,
                "tgl_masuk"=>$faker->tgl_masuk,
                "divisi"=>$faker->divisi,
                "bagian"=>$faker->bagian,
            ]);
        }
        
        // \App\Models\User::factory(10)->create();
    }
}
