<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

public function canAccessPanel(Panel $panel): bool
{
    \Log::info('canAccessPanel check', [
        'panel_id' => $panel->getId(),
        'user_email' => $this->email,
        'user_role' => $this->role,
    ]);

    // Landlord panel - allow any authenticated user
    if ($panel->getId() === 'admin') {
        return true; // ✅ No role check for landlord
    }

    // Tenant panel - require admin role
    if ($panel->getId() === 'tenant') {
        return isset($this->role) && $this->role === 'admin';
    }

    return false;
}

    /**
     * Override newQuery to use the correct connection based on context
     */
    public function newQuery()
    {
        // If tenancy is initialized, use tenant database
        if (tenancy()->initialized) {
            $dbName = tenancy()->tenant->getDatabaseName();

            if (config('database.connections.mysql.database') !== $dbName) {
                config(['database.connections.mysql.database' => $dbName]);
                \DB::purge('mysql');
                \DB::reconnect('mysql');
            }

            // Use mysql connection for tenants
            $this->connection = 'mysql';
        } else {
            // Use landlord connection for central admin
            $this->connection = 'landlord';
        }

        return parent::newQuery();
    }

    /**
     * Get the database connection for the model
     */
    public function getConnectionName()
    {
        // If tenancy is initialized, use mysql connection
        if (tenancy()->initialized) {
            return 'mysql';
        }

        // Otherwise use landlord connection
        return 'landlord';
    }
}
