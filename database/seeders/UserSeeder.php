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
        $administrator = User::create([
            'name' => 'Administrator', 
            'email' => 'administrator@gmail.com', 
            'password' => 'password'
        ]);
        $superRole = Role::create(['name' => 'administrator']); 
        $administrator->assignRole('administrator');
        
        
        $user = User::create([
            'name' => 'User', 
            'email' => 'user@gmail.com', 
            'password' => 'password'
        ]);
    
        $userRole = Role::create(['name' => 'user']); 
        $user->assignRole('user');
        
        $manager = User::create([
            'name' => 'Manager', 
            'email' => 'manager@gmail.com', 
            'password' => 'password'
        ]);
    
        $managerRole = Role::create(['name' => 'manager']); 
        $manager->assignRole('manager');
    }
}
