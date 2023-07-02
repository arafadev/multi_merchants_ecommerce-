<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Admin' . ' ' . Str::random(10),
            'username' => 'admin' . rand(1, 10),
            'email' => Str::random(10) . '@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'photo' => 'upload/no_image.jpg',
            'remember_token' => Str::random(10),
        ];
    }
}
