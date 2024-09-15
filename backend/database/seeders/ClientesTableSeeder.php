<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $numeroDeClientes = 10;

        for ($i = 0; $i < $numeroDeClientes; $i++) {
            DB::table('clientes')->insert([
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
