<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'admin',
            'label' => 'Administrateur',
            'description' => 'Administrateur de Système'
        ]);
        $teacher = Role::create([
            'name' => 'teacher',
            'label' => 'Enseignant',
            'description' => 'Enseignant expert'
        ]);
        $student = Role::create([
            'name' => 'student',
            'label' => 'Etudiant',
            'description' => 'Etudiant régulière'
        ]);

        $admin->givePermissionTo([
            'superadmin',
        ]);

        $teacher->givePermissionTo([
            'teacheruser',
        ]);

        $student->givePermissionTo([
            'studentuser'
        ]);
    }
}
