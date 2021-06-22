<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $RolesFind = Role::find(1 && 2 && 3 && 4 && 5);

         Role::create(['name' => 'Superadmin','slug' => 'superadmin', 'permissions' => $this->getAdminRolePermissions()]);

         Role::create(['name' => 'Admin','slug' => 'admin', 'permissions' => $this->getDemoAdminRolePermissions()]);

    }
            private function getAdminRolePermissions()
    {
        return [

            "users_read" => true,
            "users_write" => true,
            "users_delete" => true,
        ];
    }
     private function getDemoAdminRolePermissions()
    {
        return [

            "users_read" => true,
            "users_write" => true,
        ];
}
}
