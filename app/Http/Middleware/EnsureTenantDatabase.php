<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantDatabase
{
    public function handle(Request $request, Closure $next): Response
    {
        if (tenancy()->initialized) {
            $tenant = tenancy()->tenant;
            
            // Force set the database on mysql connection
            config(['database.connections.mysql.database' => $tenant->getDatabaseName()]);
            DB::purge('mysql');
            DB::reconnect('mysql');
            
            // Log for debugging
            \Log::info('EnsureTenantDatabase middleware', [
                'tenant_id' => $tenant->id,
                'database' => DB::connection('mysql')->getDatabaseName(),
            ]);
        }
        
        return $next($request);
    }
}