<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = [
            'Avatar 1',
            'Avatar 2',
            'Avatar 3',
            'Avatar 4',
            'Avatar 5'
        ];

        for ($i=1; $i <= 5; $i++) { 
            Avatar::create([
                'name' => $name[$i - 1],
                'price' => rand(50, 100000),
                'path' => '/assets/images/avatar/'.$i.'.jpg'
            ]);
        }
    }
}
