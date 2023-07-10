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
            'username' => 'vendor' . 1,
            'email' => 'vendor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('vendor'),
            'phone' => '123456789',
            'address' => fake()->address,
            'vendor_join' => '2022-07-1',
            'vendor_short_info' => fake()->paragraphs(1, true),
            'status' => fake()->randomElement(Vendor::$status),
            'photo' => 'upload/no_image.jpg',
            'remember_token' => Str::random(10),
        ]);
        Vendor::factory()->count(10)->create();
    }
}
