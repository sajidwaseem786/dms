<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class CreateTenantCommand extends Command
{
    protected $signature = 'tenant:create 
                            {name : The name of the organization}
                            {email : Admin email address}
                            {domain : Subdomain for the tenant}
                            {--password= : Custom password (optional)}';

    protected $description = 'Create a new tenant with database and admin user';

    public function handle()
    {
        try {
            $name = $this->argument('name');
            $email = $this->argument('email');
            $domain = $this->argument('domain');
            $password = $this->option('password') ?? Str::random(16);

            $this->info('Creating tenant...');

            // Create tenant record on landlord connection
            $tenant = Tenant::create([
                'id' => Str::slug($domain),
                'name' => $name,
                'email' => $email,
            ]);

            $this->info("✓ Tenant created: {$tenant->id}");

            // Add domain
            $tenant->domains()->create([
                'domain' => $domain . '.localhost',
            ]);

            $this->info("✓ Domain added: {$domain}.localhost");

            // Get database name
            $databaseName = $tenant->getDatabaseName();
            
            $this->info("Creating database: {$databaseName}...");
            
            // Create database using landlord connection
            DB::connection('landlord')->statement("CREATE DATABASE IF NOT EXISTS `{$databaseName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $this->info("✓ Database '{$databaseName}' created");

            // Configure mysql connection to point to tenant database
            config(['database.connections.mysql.database' => $databaseName]);
            DB::purge('mysql');
            DB::reconnect('mysql');

            // Verify connection
            $this->info('Switching to tenant database...');
            $currentDb = DB::connection('mysql')->getDatabaseName();
            $this->info("Connected to: {$currentDb}");

            if ($currentDb !== $databaseName) {
                throw new \Exception("Failed to switch to tenant database. Expected: {$databaseName}, Got: {$currentDb}");
            }

            // Run migrations on mysql connection (tenant database)
            $this->info('Running tenant migrations...');
            
            $exitCode = Artisan::call('migrate', [
                '--database' => 'mysql',
                '--path' => 'database/migrations/tenant',
                '--force' => true,
            ]);
            
            // Show migration output
            echo Artisan::output();
            
            if ($exitCode !== 0) {
                throw new \Exception('Migration failed with exit code: ' . $exitCode);
            }
            
            $this->info('✓ Migrations completed');

            // Verify tables were created
            $tables = DB::connection('mysql')->select('SHOW TABLES');
            $this->info("✓ Tables created: " . count($tables));

            // Create admin user using mysql connection (tenant database)
            $this->info('Creating admin user...');
            
            // Use DB::connection('mysql') to ensure we're on tenant database
            DB::connection('mysql')->table('users')->insert([
                'name' => $name . ' Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $this->info("✓ Admin user created!");

            // Verify user was created in tenant database
            $userCount = DB::connection('mysql')->table('users')->count();
            $this->info("✓ Users in tenant database: {$userCount}");

            // Display success information
            $this->newLine();
            $this->info("=== Tenant Created Successfully ===");
            $this->info("Tenant ID: {$tenant->id}");
            $this->info("Database: {$databaseName}");
            $this->info("Domain: {$domain}.localhost");
            $this->info("Admin Email: {$email}");
            $this->info("Admin Password: {$password}");
            $this->newLine();
            $this->warn("⚠️  IMPORTANT: Save this password - it won't be shown again!");
            $this->newLine();
            $this->info("Access your tenant admin at:");
            $this->info("http://{$domain}.localhost:8000/admin");

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error("❌ Error creating tenant: " . $e->getMessage());
            $this->error("File: " . $e->getFile() . " Line: " . $e->getLine());
            
            // Show stack trace for debugging
            if ($this->option('verbose')) {
                $this->error($e->getTraceAsString());
            }
            
            return self::FAILURE;
        }
    }
}