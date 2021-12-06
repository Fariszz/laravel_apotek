<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 10; $i++) {
            DB::table('product')->insert([
                'user_id' => $faker->randomElement([1,2]),
                'category_id' => $faker->randomElement([1,2]),
                'nama' => $faker->name(),
                'description' => $faker->sentence(),
                'harga' => $faker->numerify('######'),
                'stok' => $faker->numerify('###'),
                'telfon' => '6812345678'
            ]);
        }
    }
}
