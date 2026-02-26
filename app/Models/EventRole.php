<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventRole extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'event_id',
        'role_id',
        'required_count',
        'compensation_type',
        'volunteer_type_ids',
        'compensation_amount',
    ];

    protected $casts = [
        'required_count' => 'integer',
        'compensation_amount' => 'decimal:2',
        'volunteer_type_ids' => 'array',
    ];

    /**
     * Relationship to Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function role()
    {
        return $this->belongsTo(VolunteerRole::class);
    }
    /**
     * Get formatted compensation
     */
    public function getFormattedCompensationAttribute()
    {
        switch ($this->compensation_type) {
            case 'none':
                return 'Unpaid';
            case 'fixed':
                return $this->compensation_amount
                    ? '€' . number_format((float) $this->compensation_amount, 2)
                    : 'Unpaid';
            case 'hourly':
                return $this->compensation_amount
                    ? '€' . number_format((float) $this->compensation_amount, 2) . '/hour'
                    : 'Unpaid';
            default:
                return 'N/A';
        }
    }
    /**
     * Relationship to VolunteerRegistrations
     */
    public function registrations()
    {
        return $this->belongsToMany(VolunteerRegistration::class,'volunteer_event_roles');
    }
}
