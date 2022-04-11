<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name'           => 'admin',
            'email'          => 'admin@admin.com',
            'is_active'      => 1,
            'type'           => 1,
            'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',   // password
            'remember_token' => str::random(10),
        ]);

        User::Create([
            'name'           => 'author',
            'email'          => 'author@author.com',
            'is_active'      => 1,
            'type'           => 0,
            'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',   // password
            'remember_token' => Str::random(10),
        ]);

        User::Create([
            'name'           => 'author2',
            'email'          => 'author2@author2.com',
            'is_active'      => 0,
            'type'           => 2,
            'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',   // password
            'remember_token' => Str::random(10),
        ]);
    }
}