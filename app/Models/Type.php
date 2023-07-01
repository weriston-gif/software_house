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
  


    public static function getAllTypes()
    {
        return self::all();
    }

    public function userProjectBudgetType()
    {
        return $this->hasMany(UserProjectBudgetType::class);
    }
}
