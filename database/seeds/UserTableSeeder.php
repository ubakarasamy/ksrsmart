<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    $role_superadmin = Role::where('name', 'superadmin')->first();
    $role_admin  = Role::where('name', 'admin')->first();
    $role_subadmin  = Role::where('name', 'subadmin')->first();
    $role_user  = Role::where('name', 'user')->first();
    $role_subuser = Role::where('name', 'subuser')->first();

    $superadmin= new User();
    $superadmin->name = 'superadmin Name';
    $superadmin->email = 'superadmin@app.com';
    $superadmin->password = bcrypt('password');
    $superadmin->dashboard_role = $role_superadmin->name;
    $superadmin->eid = 'Eid1';
    $superadmin->working_department = 'Depart';
    $superadmin->occupation = 'Occupation';
    $superadmin->status = 'current';
    $superadmin->save();
    $superadmin->roles()->attach($role_superadmin);


    $admin = new User();
    $admin->name = 'admin Name';
    $admin->email = 'admin@app.com';
    $admin->password = bcrypt('password');
    $admin->dashboard_role = $role_admin->name;
    $admin->eid = 'Eid2';
    $admin->working_department = 'Depart';
    $admin->occupation = 'Occupation';
    $admin->status = 'current';
    $admin->save();
    $admin->roles()->attach($role_admin);

    $subadmin = new User();
    $subadmin->name = 'subadmin Name';
    $subadmin->email = 'subadmin@app.com';
    $subadmin->password = bcrypt('password');
    $subadmin->dashboard_role = $role_subadmin->name;
    $subadmin->eid = 'Eid3';
    $subadmin->working_department = 'Depart';
    $subadmin->occupation = 'Occupation';
    $subadmin->status = 'current';
    $subadmin->save();
    $subadmin->roles()->attach($role_subadmin);

    $user = new User();
    $user->name = 'user Name';
    $user->email = 'user@app.com';
    $user->password = bcrypt('password');
    $user->dashboard_role = $role_user->name;
    $user->eid = 'Eid4';
    $user->working_department = 'Depart';
    $user->occupation = 'Occupation';
    $user->status = 'current';
    $user->save();
    $user->roles()->attach($role_user);

    $subuser = new User();
    $subuser->name = 'subuser Name';
    $subuser->email = 'subuser@app.com';
    $subuser->password = bcrypt('password');
    $subuser->dashboard_role = $role_subuser->name;
    $subuser->eid = 'Eid5';
    $subuser->working_department = 'Depart';
    $subuser->occupation = 'Occupation';
    $subuser->status = 'current';
    $subuser->save();
    $subuser->roles()->attach($role_subuser);



    }
}
