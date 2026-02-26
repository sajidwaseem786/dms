<?php

namespace App\Models;

use App\Models\CustomFieldValue;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $connection = 'mysql';
    protected $fillable = [
        'name',
        'key',
        'type',
        'entity_type',
        'is_required',
        'is_active',
        'options',
        'sort',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function values()
    {
        return $this->hasMany(CustomFieldValue::class);
    }
}
