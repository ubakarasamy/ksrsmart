<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
    $role_employee = new Role();
    $role_employee->name = 'superadmin';
    $role_employee->description = 'superadmin User';
    $role_employee->save();

    $role_manager = new Role();
    $role_manager->name = 'admin';
    $role_manager->description = 'admin User';
    $role_manager->save();

    $role_manager = new Role();
    $role_manager->name = 'subadmin';
    $role_manager->description = 'subadmin User';
    $role_manager->save();

    $role_manager = new Role();
    $role_manager->name = 'user';
    $role_manager->description = 'User';
    $role_manager->save();

    $role_manager = new Role();
    $role_manager->name = 'subuser';
    $role_manager->description = 'subuser User';
    $role_manager->save();
  
    }
}
