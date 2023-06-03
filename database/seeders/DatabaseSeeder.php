<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();
        \App\Models\User::upsert([
            'id' => 1,
            'email' => 'admin@test.local',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('Nayose@2021'),
            'name' => 'System',
        ], ['id']);
    }
}
