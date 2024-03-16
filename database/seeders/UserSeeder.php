<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Elmalika we Elamir',
            'email' => 'MWA@superadmin.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'phone' => '01115867229',
            'address' => 'Manshya Elbakary, Faisal Giza',
        ]);

        User::create([
            'name' => 'Omar',
            'email' => 'omar@admin.com',
            'password' => Hash::make('1234567'),
            'phone' => '01148992811',
            'address' => 'Old cairo, Kabsh castle Cairo',
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Nuby',
            'email' => 'nuby@admin.com',
            'password' => Hash::make('12345678'),
            'phone' => '01110037972',
            'address' => 'Kaabish Tawabiq, Faisal Giza',
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Miecky',
            'email' => 'mcmc@admin.com',
            'phone' => '01115867229',
            'address' => 'Manshya Elbakary, Faisal Giza',
            'password' => Hash::make('123456789'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Reda Teqnawty',
            'email' => 'reda@customer.com',
            'password' => Hash::make('12345678910'),
            'phone' => '01218875319',
            'address' => 'Embaba , Giza',
            'role_id' => 3
        ]);

        User::create([
            'name' => 'Eltawheed store',
            'email' => 'Eltawheed@merchant.com',
            'password' => Hash::make('1234567891011'),
            'phone' => '01256785098',
            'address' => 'Elshahied st , Qalyubya',
            'img' => 'Eltawheed.jpg' ,
            'role_id' => 4
        ]);

    }
}
