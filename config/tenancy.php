<?php

declare(strict_types=1);

return [
    'tenant_model' => \App\Models\Tenant::class,
    'id_generator' => \Stancl\Tenancy\UuidGenerator::class,

    'central_domains' => [
        '127.0.0.1',
        'localhost',
    ],

    'database' => [
        'based_on' => null,
        'prefix' => 'tenant_',
        'suffix' => '',
        'template_tenant_connection' => 'mysql', // ✅ This must be 'mysql'
        'managers' => [
            'mysql' => \Stancl\Tenancy\Database\Managers\MySQLDatabaseManager::class,
        ],
    ],

    'bootstrappers' => [
        \Stancl\Tenancy\Bootstrappers\DatabaseTenancyBootstrapper::class, // ✅ This MUST be here
        \Stancl\Tenancy\Bootstrappers\CacheTenancyBootstrapper::class,
        \Stancl\Tenancy\Bootstrappers\FilesystemTenancyBootstrapper::class,
        \Stancl\Tenancy\Bootstrappers\QueueTenancyBootstrapper::class,
    ],

    'features' => [],

    'migration_parameters' => [
        '--force' => true,
        '--path' => [database_path('migrations/tenant')],
    ],

    'seeder_parameters' => [
        '--class' => 'DatabaseSeeder',
    ],
];