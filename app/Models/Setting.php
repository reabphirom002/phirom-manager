<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    // មុខងារសម្រាប់ឆែកមើលថា Owner បានបើកសិទ្ធិ On ឬ Off
    public static function check(string $key): bool
    {
        $setting = self::where('key', $key)->first();
        return $setting ? (bool)$setting->value : false;
    }
}