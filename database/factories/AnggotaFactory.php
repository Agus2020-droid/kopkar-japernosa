<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;


class AnggotaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Anggota::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nik_anggota' => $this->faker->randomNumber(),
            'nama_anggota' => $this->faker->name(),
            'tempat_lahir' => $this->faker->address(),
            'tgl_lahir' => $this->faker->dateTime(),
            'status' => $this->faker->status(),
            'alamat_anggota' => $this->faker->alamat_anggota(),
            'telp' => $this->faker->phoneNumber(),
            'tgl_masuk' => $this->faker->dateTime(),
            'divisi' => $this->faker->divisi(),
            'bagian' => $this->faker->bagian(),
        ];
    }

}
