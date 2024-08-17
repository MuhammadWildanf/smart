<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userPermissions = [
            'dashboard',
            'login',
            'profile.index',
            'profile.update',
            'logout',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'password.confirm',
            'list-cars.index',
            'list-cars.create',
            'list-cars.store',
            'list-cars.show',
            'list-cars.edit',
            'list-cars.update',
            'list-cars.destroy',
            'recomendation.index',
            'recomendation.create',
            'recomendation.store',
            'recomendation.show',
            'recomendation.edit',
            'recomendation.update',
            'recomendation.destroy',
            'recomendation.calculate',
            'hasil-akhir.index',
            'hasil-akhir.create',
            'hasil-akhir.store',
            'hasil-akhir.show',
            'hasil-akhir.edit',
            'hasil-akhir.update',
            'hasil-akhir.destroy',
            'hasil-akhir.download',
            'dashboard.getDataChart'
        ];

        $administratorPermissions = [
            'dashboard',
            'history.index',
            'history.download',
            'evaluation.index',
            'evaluation.create',
            'evaluation.store',
            'evaluation.show',
            'evaluation.edit',
            'evaluation.update',
            'evaluation.destroy',
            'subcriteria.update',
            'subcriteria.destroy',
            'subcriteria.create',
            'subcriteria.store',
            'subcriteria.index',
            'subcriteria.show',
            'subcriteria.edit',
            'criteria.update',
            'criteria.edit',
            'criteria.show',
            'criteria.destroy',
            'criteria.create',
            'criteria.store',
            'criteria.index',
            'cars.destroy',
            'cars.create',
            'cars.store',
            'cars.index',
            'cars.show',
            'cars.edit',
            'cars.update',
            'users.index',
            'users.create',
            'users.store',
            'users.show',
            'users.edit',
            'users.update',
            'users.destroy',
            'users.roles.index',
            'users.roles.create',
            'users.roles.store',
            'users.roles.show',
            'users.roles.edit',
            'users.roles.update',
            'users.roles.destroy',
            'users.permissions.index',
            'users.permissions.create',
            'users.permissions.store',
            'users.permissions.show',
            'users.permissions.edit',
            'users.permissions.update',
            'users.permissions.destroy',
            'dashboard.getDataChart'
        ];

        $managerPermissions = [
            'dashboard',
            'history.index',
            'history.download',
            'dashboard.getDataChart',
            'list-cars.index',
            'evaluation.index',
        ];

        $allPermissions = array_merge($userPermissions, $administratorPermissions, $managerPermissions);
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat Peran dan Tetapkan Izin
        $roleUser = Role::firstOrCreate(['name' => 'user']);
        $roleUser->syncPermissions($userPermissions);

        $roleSuperuser = Role::firstOrCreate(['name' => 'administrator']);
        $roleSuperuser->syncPermissions($administratorPermissions);

        $roleManager = Role::firstOrCreate(['name' => 'manager']);
        $roleManager->syncPermissions($managerPermissions);
    }
}
