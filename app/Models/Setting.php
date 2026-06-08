<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = ['variable', 'value'];

    protected $connection = 'mysql';

    /**
     * Get a raw setting value by variable key.
     */
    public static function get(string $variable, mixed $default = null): mixed
    {
        return static::query()->where('variable', $variable)->value('value') ?? $default;
    }

    /**
     * Get a setting decoded as an array (for JSON settings like planningcat).
     */
    public static function getArray(string $variable, array $default = []): array
    {
        $raw = static::get($variable);
        if (! $raw) {
            return $default;
        }
        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : $default;
    }

    /**
     * Set (create or update) a setting.
     */
    public static function set(string $variable, mixed $value): void
    {
        static::updateOrCreate(
            ['variable' => $variable],
            ['value' => is_array($value) ? json_encode($value) : $value],
        );
    }
}