<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jonathan',
            'email' => 'ruizsilvajonathan@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::factory(10)->create();
    }
}
