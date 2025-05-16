<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{
    public function createUser(array $data)
    {
        if (!$data['role']) {
            throw new \InvalidArgumentException("Invalid role: " . $data['role']);
        }

        // not for bulk creation
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($data['role'] == "admin"){
            $role = Role::firstOrCreate(['name' => 'admin']);
        }
        if ($data['role'] == "teacher"){
            $role = Role::firstOrCreate(['name' => 'teacher']);
        }
        if ($data['role'] == "student"){
            $role = Role::firstOrCreate(['name' => 'student']);
        } 
    
        //assign role
        $user->assignRole($role);
        return $user;
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }
}
