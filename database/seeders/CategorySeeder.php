<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            ['nama' => 'obat',
            'slug' => 'obat'],
            ['nama' => 'perlengkapan kesehatan',
            'slug' => 'perkesatan'],
        ];

        DB::table('category')->insert($category);
    }
}
