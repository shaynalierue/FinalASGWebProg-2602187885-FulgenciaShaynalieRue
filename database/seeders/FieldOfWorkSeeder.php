<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FieldOfWork;

class FieldOfWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FieldOfWork::create(['name' => 'Technology']);
        FieldOfWork::create(['name' => 'Marketing']);
        FieldOfWork::create(['name' => 'Design']);
        FieldOfWork::create(['name' => 'Business']);
        FieldOfWork::create(['name' => 'Sales']);
    }
}
