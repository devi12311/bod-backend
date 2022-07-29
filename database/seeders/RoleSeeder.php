<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(UserRole::values())->each(fn($role) => Role::create([
            'name' => $role, 'guard_name' => 'sanctum'
        ]));
    }
}
