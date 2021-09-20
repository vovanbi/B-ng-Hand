<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Nguyen Van A',
            'email' => 'shoesshop.ued@gmail.com',
            'password' => bcrypt('123'),
            'type' => 0,
        ]);
        \DB::table('categories')->insert([
            'c_name' => 'Áo',
            'c_slug' => 'ao',
            'c_home' => 1,
        ]);
        \DB::table('categories')->insert([
            'c_name' => 'Quần',
            'c_slug' => 'quan',
            'c_home' => 1,
        ]);
    }
}
