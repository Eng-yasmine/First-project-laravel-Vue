<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminRole();
        $this->createVendorRole();
    }

    protected function createRole(RoleName $role , Collection $permissions)
    {
        $role = Role::create(['name' => $role->value]);

        $role->permissions()->sync($permissions);
    }

    protected function createAdminRole() : void
    {
        $permissions = Permission::query()
        ->where('name', 'like', '%user.%')
        ->orWhere('name', 'like', '%restaurant.%')
        ->pluck('id');

        $this->createRole(RoleName::ADMIN, $permissions);
    }

    public function createVendorRole() : void
    {
        $this->createRole(RoleName::VENDOR, collect());
    }
}
