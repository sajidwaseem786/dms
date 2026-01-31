<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VolunteerRegistration extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'event_id',
        'event_role_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'calculated_compensation' => 'decimal:2',
    ];

    /**
     * Relationship to Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relationship to EventRole
     */
    public function eventRole()
    {
        return $this->belongsToMany(EventRole::class, 'volunteer_event_roles');
    }

    /**
     * Relationship to User (Volunteer)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get formatted compensation
     */
    public function getFormattedCompensationAttribute()
    {
        return $this->calculated_compensation
            ? '€' . number_format((float) $this->calculated_compensation, 2)
            : 'Unpaid';
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'gray',
        };
    }
}
