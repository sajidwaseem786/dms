<?php

namespace App\Models;

use App\Models\CustomFieldValue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    public function customFieldValues()
    {
        return $this->morphMany(CustomFieldValue::class, 'valuable');
    }
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'status',
        'created_by',
        'reminder_sent',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'reminder_sent' => 'boolean',
        // Times are stored as strings by default, no need to cast
    ];
    /**
     * Relationship to EventRoles
     */
    public function roles()
    {
        return $this->hasMany(EventRole::class);
    }

    // ✅ Accessor to get combined start datetime
    public function getStartDatetimeAttribute(): ?Carbon
    {
        if (!$this->start_date || !$this->start_time) {
            return null;
        }

        return Carbon::parse("{$this->start_date} {$this->start_time}");
    }

    public function getEndDatetimeAttribute(): ?Carbon
    {
        if (!$this->end_date || !$this->end_time) {
            return null;
        }

        return Carbon::parse("{$this->end_date} {$this->end_time}");
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    /**
     * Relationship to VolunteerRegistrations
     */
    public function registrations()
    {
        return $this->hasMany(VolunteerRegistration::class);
    }
}
