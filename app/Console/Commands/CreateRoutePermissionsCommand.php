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
        $roleUser = Role::findByName('user'); // Ganti 'user' dengan nama peran yang Anda inginkan
        $roleAdmin = Role::findByName('superuser'); // Ganti 'user' dengan nama peran yang Anda inginkan
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

        foreach($routes as $route)
        {
            if($route->getName() !='' && $route->getAction()['middleware'][0]=='web')
            {
                $permission = Permission::where('name', $route->getName())->first();
                if(is_null($permission))
                {
                    $permission = permission::create(['name' => $route->getName()]);
                }

                if (in_array($permission->name, $p)) {
                    // Assign permission to the role
                    if (!$roleUser->hasPermissionTo($permission)) {
                        $roleUser->givePermissionTo($permission);
                    }
                }

                $roleAdmin->givePermissionTo($permission);
            }
        }

        $this->info('Permission Route Added Successfully');
    }
}
