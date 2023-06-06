<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0123456789',
            'password' => bcrypt(123456789),
            'role_id' => User::IS_ADMIN,
        ];

        $user = User::where('email', 'admin@gmail.com')->exists();
        if (!$user) {
            User::create($data);
        }
    }
}
