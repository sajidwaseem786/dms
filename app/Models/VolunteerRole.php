<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VolunteerRole extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = ['name','description'];
    /**
     * Relationship to EventRoles
     */
    public function eventRoles()
    {
        return $this->hasMany(EventRole::class);
    }
}
