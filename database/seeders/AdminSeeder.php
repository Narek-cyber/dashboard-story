<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'John Doe',
                'role' => 'admin',
                'email' => 'sahakyannarek023@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Jenna Doe',
                'role' => 'admin',
                'email' => 'jennadoe@gmail.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($admins as $admin) {
            User::query()->firstOrCreate(['email' => $admin['email']], $admin);
        }
    }
}
