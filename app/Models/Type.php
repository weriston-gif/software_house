<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    const TYPE_EXISTES_WEB = 1;

    const TYPE_EXISTES_MOBILE = 2;

    const TYPE_EXISTES_DESKTOP = 3;


    protected $fillable = [
        'description',
        'value_page_login',
        'value_per_page',
    ];


    public static function arrayTypes()
    {
        $system_operacional = [
            self::TYPE_EXISTES_WEB => 'Web',
            self::TYPE_EXISTES_MOBILE => 'Mobile',
            self::TYPE_EXISTES_DESKTOP => 'Desktop',
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
