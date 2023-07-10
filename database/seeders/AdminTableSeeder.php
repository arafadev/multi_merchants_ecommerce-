<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Master Admin',
            'username' => 'admin' . 1,
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'phone' => '123456789',
            'address' => fake()->address,
            'photo' => 'upload/no_image.jpg',
            'remember_token' => Str::random(10),
        ]);
        Admin::factory()->count(10)->create();
    }
}
