<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 
        'value', 
        'type', 
        'group', 
        'description'
    ];

    /**
     * Mendapatkan nilai setting berdasarkan key
     */
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Menyimpan atau mengupdate nilai setting
     */
    public static function setValue($key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Mendapatkan semua setting berdasarkan group
     */
    public static function getGroup($group)
    {
        return self::where('group', $group)->get();
    }

    /**
     * Mendapatkan semua setting yang dikelompokkan
     */
    public static function getAllGrouped()
    {
        return self::all()->groupBy('group');
    }
}