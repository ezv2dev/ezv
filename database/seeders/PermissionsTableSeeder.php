<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Permission::create([
            'name' => 'villatype-index' // id 1
        ]);
        App\Permission::create([
                'name' => 'villatype-create' // id 2
        ]);
        App\Permission::create([
                'name' => 'villatype-show' // id 3
        ]);
        App\Permission::create([
                'name' => 'villatype-update' // id 4
        ]);
        App\Permission::create([
                'name' => 'villatype-delete' // id 5
        ]);
        
        $admin = App\Role::where('name', 'superadmin')->first();
        $admin->permissions()->attach([1, 2, 3, 4, 5]);

        $admin = App\Role::where('name', 'admin')->first();
        $admin->permissions()->attach([1]);
    }
}
