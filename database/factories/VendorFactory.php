<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Vendor' . ' ' . Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('vendor'),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'vendor_short_info' => fake()->paragraphs(1, true),
            'vendor_join' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),            'status' => fake()->randomElement(Vendor::$status),
            'photo' => 'no_image.jpg',
            'remember_token' => Str::random(10),
        ];
    }
}
