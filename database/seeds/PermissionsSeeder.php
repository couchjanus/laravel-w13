<?php

use Illuminate\Database\Seeder;
use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Удаляем предыдущие данные
        DB::table('permissions')->truncate();

        $permissions = array(
            array('name' => 'User Management Access'),
            array('name' => 'Permission Create'),
            array('name' => 'Permission Edit'),
            array('name' => 'Permission Show'),
            array('name' => 'Permission Delete'),
            array('name' => 'Permission Access'),
            array('name' => 'Role Create'),
            array('name' => 'Role Edit'),
            array('name' => 'Role Show'),
            array('name' => 'Role Delete'),
            array('name' => 'Role Access'),
            array('name' => 'User Create'),
            array('name' => 'User Edit'),
            array('name' => 'User Show'),
            array('name' => 'User Delete'),
            array('name' => 'User Access'),
        );
        
        /** Add Permissions    */
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'slug' => Str::slug($permission['name']),
            ]);
        }
    }
}
