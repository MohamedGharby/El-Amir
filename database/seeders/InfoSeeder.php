<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::create([
            'name' => 'Elmalika we Elamir',
            'email' => 'MWA@gmail.com',
            'phone' =>'01018041211',
            'address'=>'Manshya Elbakary, Faisal Giza',
            'facebook' => 'https://www.facebook.com',
            'x' => 'https://www.x.com',
            'instagram' => 'https://www.instagram.com',
            'linkedin' => 'https://www.linkedin.com',
        ]);
    }
}
