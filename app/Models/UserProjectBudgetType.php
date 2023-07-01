<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProjectBudgetType extends Model
{
    use HasFactory;

    protected $table = 'user_project_budget_type';

    protected $fillable = [
        'user_project_budget_id',
        'type_id',
        'final_budget_value',
    ];

    public function userProjectBudget()
    {
        return $this->belongsTo(UserProjectBudget::class, 'user_project_budget_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
