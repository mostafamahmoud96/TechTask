<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::Create([
            'name' => 'Admin',
            'guard_name'  => 'web'
        ]);
        Role::Create([
            'name' => 'Author',
            'guard_name'  => 'web'
        ]);
        
    }
}
