<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nik_ktp' => '3303021708860004',
                'name' => 'Agus Dwi Anggoro',
                'email' => 'abie.ang@gmail.com',
                'level' => 'Host',
                'password' => bcrypt('admin1234'),
                'foto_user' => 'user.png'
            ],
            [
                'nik_ktp' => '3302020804840005',
                'name' => 'Kisman',
                'email' => 'Kisman@sampoernakayoe.co.id',
                'level' => 'Admin',
                'password' => bcrypt('admin5678'),
                'foto_user' => 'user.png'
            ],
            [
                'nik_ktp' => '3302022812820002',
                'name' => 'Riyadi',
                'email' => 'Riyadi@sampoernakayoe.co.id',
                'level' => 'SuperAdmin',
                'password' => bcrypt('superadmin5678'),
                'foto_user' => 'user.png'
            ]
            ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
