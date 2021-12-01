<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $admin = [
            ['name' => 'admin',
            'email' => 'admin@mail.com',
            'alamat' => 'alamat admin',
            'role_id' => 1,
            'password' => Hash::make('admin')]
        ];

        DB::table('users')->insert($admin);

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'alamat' => $faker->sentence(),
                'role_id' => $faker->randomElement([2,3]),
                'password' => Hash::make('password')
            ]);
        }
    }
}
