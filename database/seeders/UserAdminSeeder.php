<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'is_active'   => true,
            'password' => bcrypt('admin@mail.com'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Creating Teacher User
        $teacher = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@mail.com',
            'is_active'   => true,
            'password' => bcrypt('teacher@mail.com'),
            'email_verified_at' => now(),
        ]);
        $teacher->assignRole('teacher');

        // Creating Student User
        $student = User::create([
            'name' => 'Student',
            'email' => 'etudiant@mail.com',
            'is_active'   => true,
            'password' => bcrypt('student@mail.com'),
            'email_verified_at' => now(),
        ]);
        $student->assignRole('student');
    }
}
