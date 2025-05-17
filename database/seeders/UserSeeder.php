<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure the 'admin' role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        // Create 20,000 users and assign each the 'admin' role
        User::factory()->count(10000)->create()->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
        });
        User::factory()->count(5000)->create()->each(function ($user) use ($teacherRole) {
            $user->assignRole($teacherRole);
        });
        User::factory()->count(5000)->create()->each(function ($user) use ($studentRole) {
            $user->assignRole($studentRole);
        });
    }
}
