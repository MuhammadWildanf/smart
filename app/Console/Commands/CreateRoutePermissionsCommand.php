<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permission Generate And Save to DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routes = Route::getRoutes()->getRoutes();
        $roleUser = Role::findByName('user'); 
        $roleSuperuser = Role::findByName('superuser'); 
        $roleManager = Role::findByName('manager'); 
        $p = [
            'dashboard',
            'login',
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
        ];

        $managerPermissions = [
            'dashboard',
            'history.index',
        ];

        $superuserPermissions = [
            'dashboard',
            'history.index',
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
        ];

        foreach ($routes as $route) {
            if ($route->getName() != '' && $route->getAction()['middleware'][0] == 'web') {
                $permission = Permission::where('name', $route->getName())->first();
                if (is_null($permission)) {
                    $permission = permission::create(['name' => $route->getName()]);
                }

                if (in_array($permission->name, $superuserPermissions)) {
                    if (!$roleSuperuser->hasPermissionTo($permission)) {
                        $roleSuperuser->givePermissionTo($permission);
                    }
                }

                if (in_array($permission->name, ['dashboard', 'history.index'])) {
                    if (!$roleManager->hasPermissionTo($permission)) {
                        $roleManager->givePermissionTo($permission);
                    }
                }

                if (in_array($permission->name, $p)) {
                    if (!$roleUser->hasPermissionTo($permission)) {
                        $roleUser->givePermissionTo($permission);
                    }
                }
            }
        }

        $this->info('Permission Route Added Successfully');
    }
}
