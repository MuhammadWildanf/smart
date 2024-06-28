<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superuser = User::create([
            'name' => 'Superuser', 
            'email' => 'superuser@gmail.com', 
            'password' => 'password'
        ]);
        $superRole = Role::create(['name' => 'superuser']); 
        $superuser->assignRole([$superRole->id]);
        
        
        $user = User::create([
            'name' => 'User', 
            'email' => 'user@gmail.com', 
            'password' => 'password'
        ]);
    
        $userRole = Role::create(['name' => 'user']); 
        $user->assignRole([$userRole->id]);
        
        $manager = User::create([
            'name' => 'Manager', 
            'email' => 'manager@gmail.com', 
            'password' => 'password'
        ]);
    
        $managerRole = Role::create(['name' => 'manager']); 
        $manager->assignRole([$managerRole->id]);
    }
}
