<?php
namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUser();
    }

    public function createAdminUser()
    {
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('password'),
        ])->roles()->sync(Role::where('name' , RoleName::ADMIN->value)->first());
    }

    public function createVendorUser()
    {
      $vendor = User::create([
            'name'     => 'Vendor User',
            'email'    => 'vendor@vendor.com',
            'password' => bcrypt('password'),
        ]);
        $vendor->roles()->sync(Role::where('name' , RoleName::VENDOR->value)->first());

        $vendor->restaurants()->create([
            'name' => 'Vendor Restaurant',
            'address' => '123 Vendor St',
            'phone' => '123-456-7890',
        ]);
    }
}
