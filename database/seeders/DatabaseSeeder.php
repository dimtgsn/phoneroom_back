<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Position::factory()->create([
            'name' => 'regular'
        ]);
        Position::factory()->create([
            'name' => 'admin'
        ]);
        Position::factory()->create([
            'name' => 'moder'
        ]);
        User::factory(1)->create();


    }
}
