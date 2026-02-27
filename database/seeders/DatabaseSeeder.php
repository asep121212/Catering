<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MerchantProfile;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $merchant = User::create([
            'name' => 'Katering Mamak Ani',
            'email' => 'merchant@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'merchant'
        ]);

        MerchantProfile::create([
            'user_id' => $merchant->id,
            'store_name' => 'PT Transindo', 
            'address' => 'Jakarta',
            'phone' => '08123456789',
            'description' => 'Katering makanan sehat dan higienis'
        ]);

        Menu::create([
            'merchant_id' => $merchant->id,
            'name' => 'Nasi Box Ayam Bakar',
            'description' => 'Nasi + Ayam Bakar + Lalap + Sambal',
            'price' => 25000
        ]);

        Menu::create([
            'merchant_id' => $merchant->id,
            'name' => 'Nasi Box Rendang',
            'description' => 'Nasi + Rendang + Sayur + Kerupuk',
            'price' => 30000
        ]);
        User::create([
            'name' => 'PT Transindo',
            'email' => 'customer@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer'
        ]);
    }
}