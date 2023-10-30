<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$lHeCBySewc6MxDmGZkxgyuSXcYGWg1/ZIHAAsCllRqanGWsB4bfR6',
            'role_id' => 1
        ];

        User::query()
            ->updateOrCreate($data, $data);
    }
}
