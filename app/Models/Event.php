<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

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
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
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
