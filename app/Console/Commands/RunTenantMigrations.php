<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RunTenantMigrations extends Command
{
    protected $signature = 'tenant:migrate-custom';

    protected $description = 'Run tenant migrations for all tenants';

    public function handle()
    {
        $tenants = Tenant::all();

        if ($tenants->isEmpty()) {
            $this->warn('No tenants found!');
            return self::SUCCESS;
        }

        foreach ($tenants as $tenant) {
            $this->info("Migrating tenant: {$tenant->id}");

            // Get database name
            $databaseName = $tenant->getDatabaseName();

            // Configure mysql connection to point to tenant database
            config(['database.connections.mysql.database' => $databaseName]);
            DB::purge('mysql');
            DB::reconnect('mysql');

            // Verify connection
            $currentDb = DB::connection('mysql')->getDatabaseName();
            $this->info("Connected to: {$currentDb}");

            // Run migrations
            $exitCode = Artisan::call('migrate', [
                '--database' => 'mysql',
                '--path' => 'database/migrations/tenant',
                '--force' => true,
            ]);

            // Show migration output
            echo Artisan::output();

            if ($exitCode === 0) {
                $this->info("✓ Migrations completed for tenant: {$tenant->id}");
            } else {
                $this->error("✗ Migrations failed for tenant: {$tenant->id}");
            }

            $this->newLine();
        }

        return self::SUCCESS;
    }
}
