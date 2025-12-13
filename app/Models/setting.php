<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = Cache::remember("setting_{$key}", 3600, function () use ($key) {
            return self::where('key', $key)->first();
        });

        if ($setting) {
            // Decode JSON if type is json
            if ($setting->type === 'json') {
                return json_decode($setting->value, true);
            }
            return $setting->value;
        }

        return $default;
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        // Encode to JSON if array
        if (is_array($value)) {
            $value = json_encode($value);
            $type = 'json';
        }

        $setting = self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        // Clear cache
        Cache::forget("setting_{$key}");

        return $setting;
    }

    /**
     * Get all settings by group
     */
    public static function getByGroup($group)
    {
        $settings = self::where('group', $group)->get();
        
        $result = [];
        foreach ($settings as $setting) {
            $value = $setting->value;
            
            // Decode JSON if needed
            if ($setting->type === 'json') {
                $value = json_decode($value, true);
            }
            
            $result[$setting->key] = $value;
        }

        return $result;
    }

    /**
     * Get all settings as key-value pairs
     * Renamed from all() to getAllSettings() to avoid conflict with Eloquent
     */
    public static function getAllSettings()
    {
        return Cache::remember('all_settings', 3600, function () {
            $settings = parent::all(); // Use parent::all() instead of self::all()
            
            $result = [];
            foreach ($settings as $setting) {
                $value = $setting->value;
                
                if ($setting->type === 'json') {
                    $value = json_decode($value, true);
                }
                
                $result[$setting->key] = $value;
            }

            return $result;
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache()
    {
        Cache::flush();
    }
}