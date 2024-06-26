<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateSuperUserSeeder extends Seeder
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
        $role = Role::create(['name' => 'superuser']); 
        $superuser->assignRole([$role->id]);
        
        $user = User::create([
            'name' => 'User', 
            'email' => 'user@gmail.com', 
            'password' => 'password'
        ]);
        
        $role = Role::create(['name' => 'user']); 
        $user->assignRole([$role->id]);
    }
}
