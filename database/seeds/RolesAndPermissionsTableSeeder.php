<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Webpatser\Uuid\Uuid;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view-lecturer']);
        Permission::create(['name' => 'create-lecturer']);
        Permission::create(['name' => 'update-lecturer']);
        Permission::create(['name' => 'delete-lecturer']);

        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'view-big-query']);
        Permission::create(['name' => 'create-big-query']);
        Permission::create(['name' => 'update-big-query']);
        Permission::create(['name' => 'delete-big-query']);

        Permission::create(['name' => 'access-dashboard']);
        Permission::create(['name' => 'edit-any']);

        $role = Role::create([
            'id' => Uuid::generate(4),
            'name' => 'super-admin',
        ]);

        $role->givePermissionTo(Permission::all());

        $user = \App\User::where('email', 'admin@gmail.com')->first();

        $user->assignRole('super-admin');

        $user->givePermissionTo('access-dashboard');
    }
}
