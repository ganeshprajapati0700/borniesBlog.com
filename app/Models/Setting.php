<?php

namespace App\Models;

use Database\Factories\SettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<SettingFactory> */
    use HasFactory;

    protected $guarded = [];

    /**
     * Get setting value by key.
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Get all default SEO settings.
     */
    public static function getSeoDefaults()
    {
        return [
            'title' => self::get('site_name', 'Site Name'),
            'description' => self::get('default_meta_description', ''),
            'keywords' => self::get('default_meta_keywords', ''),
            'favicon' => self::get('site_favicon', asset('img/borniesLogo.webp')),
        ];
    }
}
