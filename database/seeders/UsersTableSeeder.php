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
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2022-08-05 14:43:21',
                'verification_token' => '',
                'lastname'           => '',
                'phone'              => '',
                'address'            => '',
                'address_2'          => '',
            ],
        ];

        User::insert($users);
    }
}
