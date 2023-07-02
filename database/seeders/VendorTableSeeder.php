<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'name' => 'Master Vendor',
            'email' => 'vendor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('vendor'),
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'status' => fake()->randomElement(Vendor::$status),
            'photo' => 'no_image.jpg',
            'remember_token' => Str::random(10),
        ]);
        Vendor::factory()->count(10)->create();
    }
}
