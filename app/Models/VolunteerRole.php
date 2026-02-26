<?php

namespace App\Models;

use App\Models\CustomFieldValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerRole extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = ['name', 'description'];
    /**
     * Relationship to EventRoles
     */
    public function customFieldValues()
    {
        return $this->morphMany(CustomFieldValue::class, 'valuable');
    }
    public function eventRoles()
    {
        return $this->hasMany(EventRole::class);
    }
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_volunteer_role'
        );
    }
}
