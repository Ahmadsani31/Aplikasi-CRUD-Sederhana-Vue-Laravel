<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {
            // insert data ke table pegawai menggunakan Faker
            DB::table('mahasiswas')->insert([
                'user_id' => 2,
                'nim' => $faker->randomNumber(8, true),
                'nama' => $faker->name,
                'email' => $faker->email,
                'no_handphone' => $faker->numberBetween($min = 111111111111, $max = 99999999999),
                'alamat' => $faker->address,
            ]);
        }
    }
}
