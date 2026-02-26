<?php

namespace App\Models;

use App\Models\CustomFieldValue;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at'
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
    public function customFieldValues()
    {
        return $this->morphMany(CustomFieldValue::class, 'valuable');
    }
    public function canAccessPanel(Panel $panel): bool
    {
        \Log::info('canAccessPanel check', [
            'panel_id' => $panel->getId(),
            'user_email' => $this->email,
            'user_role' => $this->hasRole('admin'),
        ]);

        // Landlord panel - allow any authenticated user
        if ($panel->getId() === 'admin') {
            return true; // ✅ No role check for landlord
        }

        // Tenant panel - require admin role
        if ($panel->getId() === 'tenant') {
            return $this->hasRole('admin');
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
    /**
     * Relationship to VolunteerRegistrations
     */
    public function registrations()
    {
        return $this->hasMany(VolunteerRegistration::class);
    }
    public function volunteerJobRoles()
    {
        return $this->belongsToMany(
            VolunteerRole::class,
            'user_volunteer_role'
        );
    }
}
