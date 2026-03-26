<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'manager',
            'trainer'
        ];

        foreach ($roles as $role) {
            $role = Role::create(['name' => $role]);

            // Assign permissions to each role
            switch ($role->name) {
                case 'admin':
                    $role->permissions()->attach(Permission::all());
                    break;
                case 'manager':
                    $role->permissions()->attach(Permission::whereIn('name', ['view trainers', 'create trainers', 'edit trainers', 'delete trainers', 'view time logs'])->get());
                    break;
                case 'trainer':
                    $role->permissions()->attach(Permission::whereIn('name', ['view time logs', 'create time logs', 'edit time logs', 'delete time logs'])->get());
                    break;
            }
        }
    }
}
