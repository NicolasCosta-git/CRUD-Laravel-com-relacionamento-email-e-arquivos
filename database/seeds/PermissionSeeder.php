<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPermissions();
        $this->createRoles();
    }

    private function createPermissions()
    {
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission["name"]],
                $permission
            );
        }

        $this->command->info('Default permissions added');
    }

    private function createRoles()
    {
        $superadmin = Role::firstOrCreate([
            'name' => 'super_administrador',
        ]);
        $superadmin->permissions()->sync(Permission::all());
        $this->command->info('Superadmin will have full rights');
        
    }
}
