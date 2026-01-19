<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class TenantUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by their unique identifier.
     */
    public function retrieveById($identifier)
    {
        $this->ensureTenantDatabase();
        return parent::retrieveById($identifier);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     */
    public function retrieveByToken($identifier, $token)
    {
        $this->ensureTenantDatabase();
        return parent::retrieveByToken($identifier, $token);
    }

    /**
     * Retrieve a user by the given credentials.
     */
    public function retrieveByCredentials(array $credentials)
    {
        $this->ensureTenantDatabase();
        return parent::retrieveByCredentials($credentials);
    }

    /**
     * Validate a user against the given credentials.
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $this->ensureTenantDatabase();
        return parent::validateCredentials($user, $credentials);
    }

    /**
     * Ensure tenant database is set on the connection
     */
    protected function ensureTenantDatabase(): void
    {
        if (tenancy()->initialized) {
            $dbName = tenancy()->tenant->getDatabaseName();
            
            if (config('database.connections.mysql.database') !== $dbName) {
                config(['database.connections.mysql.database' => $dbName]);
                \DB::purge('mysql');
                \DB::reconnect('mysql');
            }
        }
    }
}