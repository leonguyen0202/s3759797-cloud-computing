<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Webpatser\Uuid\Uuid;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Begin : MySQL Adjustment*/
        Schema::defaultStringLength(191);
        /* End : MySQL Adjustment*/

        /* Begin Spatie: UUID Adjustment */
        Permission::retrieved(function (Permission $permission) {
            $permission->incrementing = false;
        });

        Permission::creating(function (Permission $permission) {
            $permission->incrementing = false;
            $permission->id = Uuid::generate(4)->string;
        });

        Role::retrieved(function (Role $role) {
            $role->incrementing = false;
        });

        Role::creating(function (Role $role) {
            $role->incrementing = false;
            $role->id = Uuid::generate(4)->string;
        });
        /* End Spatie: UUID Adjustment */
    }
}
