<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;

class TenantSessionGuard extends SessionGuard
{
    /**
     * Ensure tenancy is initialized before any auth operations
     */
    protected function ensureTenancyInitialized(): void
    {
        if (!tenancy()->initialized) {
            $host = request()->getHost();
            
            try {
                $domain = \Stancl\Tenancy\Database\Models\Domain::where('domain', $host)->first();
                
                if ($domain && $domain->tenant) {
                    tenancy()->initialize($domain->tenant);
                    
                    $dbName = $domain->tenant->getDatabaseName();
                    config(['database.connections.mysql.database' => $dbName]);
                    \DB::purge('mysql');
                    \DB::reconnect('mysql');
                }
            } catch (\Exception $e) {
                \Log::error('Failed to initialize tenancy in guard', [
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Get the currently authenticated user.
     */
    public function user()
    {
        $this->ensureTenancyInitialized();
        return parent::user();
    }

    /**
     * Attempt to authenticate a user using the given credentials.
     */
    public function attempt(array $credentials = [], $remember = false)
    {
        $this->ensureTenancyInitialized();
        return parent::attempt($credentials, $remember);
    }

    /**
     * Validate a user's credentials.
     */
    public function validate(array $credentials = [])
    {
        $this->ensureTenancyInitialized();
        return parent::validate($credentials);
    }

    /**
     * Get the user provider used by the guard.
     */
    public function getProvider()
    {
        $this->ensureTenancyInitialized();
        return parent::getProvider();
    }
}