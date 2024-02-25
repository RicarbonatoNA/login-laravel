<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'ricardo',
            'email' => 'gonzalez.ricardo.dev@gmail.com',
            'password' => bcrypt('4r161723'),
            'phone' => '8713928805',
            'rol_id' => 1,
        ]);
    }
}
