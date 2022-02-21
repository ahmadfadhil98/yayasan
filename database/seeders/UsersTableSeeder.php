<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'username'       => 'admin',
                'email'          => 'admin@mail.com',
                'password'       => bcrypt('password'),
                'type'           => 1,
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
