<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;
use Spatie\Permission\PermissionRegistrar;

class TenantEnsureRolesCommand extends Command
{
    protected $signature = 'tenant:ensure-roles';

    protected $description = 'Ensure required tenant roles exist (admin, volunteer)';

    public function handle(): int
    {
        // Clear permission cache (VERY IMPORTANT)
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            'admin',
            'volunteer',
        ];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(
                [
                    'name'       => $roleName,
                    'guard_name' => 'web',
                ]
            );

            $this->info("✓ Role ensured: {$role->name}");
        }

        return self::SUCCESS;
    }
}
