<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = File::get('database/data/users.json');
        $users = json_decode($users, true);

        $users = array_map(function ($type) {
            return [
                'name' => $type['name'],
                'email' => $type['email'],
                'password' => $type['password'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $users);

        DB::table('users')->insert($users);
    }
}
