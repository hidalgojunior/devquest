<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate([
            'email' => 'hidalgojunior@gmail.com',
        ], [
            'name' => 'Professor Principal',
            'password' => bcrypt('jr34139251'),
            'role' => 'teacher',
        ]);
    }
}
