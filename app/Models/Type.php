<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'description',
        'value_page_login',
        'value_per_page',
    ];
    protected $casts = [
        'value_page_login' => 'decimal',
        'value_per_page'  => 'decimal'
    ];
    private array $types = [
        [
            'id' => 1,
            'description' => 'Elaboração de sitstema Web.',
            'value_page_login' => '19.5',
            'value_per_page' => '10.3'
        ],
        [
            'id' => 2,
            'description' => 'Elaboração de sitstema Mobile.',
            'value_page_login' => '29.5',
            'value_per_page' => '12'
        ],
        [
            'id' => 3,
            'description' => 'Elaboração de sitstema Desktop.',
            'value_page_login' => '49.5',
            'value_per_page' => '15'
        ],
    ];

    public function getTypes()
    {
        return $this->types;
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
