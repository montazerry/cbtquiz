<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permissions = [
            'view course',
            'create course',
            'edit course',
            'delete course',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $teacerRole = Role::create([
            'name' => 'teacer'
        ]);

        $teacerRole->givePermissionTo([
            'view course',
            'create course',
            'edit course',
            'delete course',
        ]);

        $studentRole= Role::create([
            'name' => 'student'
        ]);

        $studentRole->givePermissionTo([
            'view course'
        ]);

        // membuat data user superadmin
        $user = User::create([
            'name' => 'Momon',
            'email' => 'momon@gmail.com',
            'password' => bcrypt('123456') ,
        ]);

        $user->assignRole($teacerRole);

    }
}
