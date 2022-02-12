<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'name' => 'Admin',
                'slug' => 'admin'
            ],
            [
                'id'    => 2,
                'name' => 'Employee',
                'slug' => 'employee'
            ]
        ];

        Role::insert($roles);
    }
}
