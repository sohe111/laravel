<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'users',
            'slug' => 'users_read',
            'description' => '',
        ]);
         Permission::create([
            'name' => 'users',
            'slug' => 'users_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'users',
            'slug' => 'users_delete',
            'description' => '',
        ]);
        
        Model::unguard();
    }
}
