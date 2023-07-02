<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Master User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user'),
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'status' => fake()->randomElement(User::$status),
            'photo' => 'no_image.jpg',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(10)->create();
    }
}
