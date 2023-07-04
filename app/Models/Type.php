<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    const BROWSER_SUPPORTS_FIREFOX = 1;
    const BROWSER_SUPPORTS_CHROME = 2;
    const BROWSER_SUPPORTS_BLIND = 3;

    const BROWSER_SUPPORTS_PLATFORM_ANDROID = 1;
    const BROWSER_SUPPORTS_PLATFORM_IOS = 2;
    const BROWSER_SUPPORTS_PLATFORM_BOTH = 3;

    const OPERATIONAL_SYSTEM_LINUX = 1;
    const OPERATIONAL_SYSTEM_WINDOWS = 2;
    const OPERATIONAL_SYSTEM_MAC = 3;
    const TYPE_ONE = 1;
    const TYPE_TWO = 2;
    const TYPE_TREE = 3;




    protected $fillable = [
        'description',
        'value_page_login',
        'value_per_page',
    ];


    public static function arrayBrowserName()
    {
        $browser = [
            self::BROWSER_SUPPORTS_FIREFOX => 'Firefox',
            self::BROWSER_SUPPORTS_CHROME => 'Google chrome',
            self::BROWSER_SUPPORTS_BLIND => 'Bling e outros',
        ];

        return $browser;
    }

    public static function arraySupportsName()
    {
        $browser = [
            self::BROWSER_SUPPORTS_PLATFORM_ANDROID => 'Android',
            self::BROWSER_SUPPORTS_PLATFORM_IOS => 'IOS',
            self::BROWSER_SUPPORTS_PLATFORM_BOTH => 'Android | IOS',
        ];

        return $browser;
    }
    public static function arrayOperacionalSystemName()
    {
        $system_operacional = [
            self::OPERATIONAL_SYSTEM_LINUX => 'Linux',
            self::OPERATIONAL_SYSTEM_WINDOWS => 'Windows',
            self::OPERATIONAL_SYSTEM_MAC => 'Mac',
        ];

        return $system_operacional;
    }


    public static function getAllTypes()
    {
        return self::all();
    }

    public function userProjectBudgetType()
    {
        return $this->hasMany(UserProjectBudgetType::class);
    }
}
