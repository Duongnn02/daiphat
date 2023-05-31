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
            'password' => bcrypt(12345678),
            'role_id' => User::IS_ADMIN,
        ];

        $users = User::get();
        foreach ($users as $user) {
            $user = User::where('email', 'admin@gmail.com')->exists();
            if ($user) {
                continue;
            }
            User::create($data);
        }
    }
}
