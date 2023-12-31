<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProjectBudgetType extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'user_project_budget_types';

    protected $fillable = [
        'user_project_budget_id',
        'type_id',
        'value_total_page',
        'browser_support',
        'platform',
        'page_login',
        'operational_system',
        'printer',
        'license_access',
        'system_pay',
        'final_budget_value',
    ];

    public function userProjectBudget()
    {
        return $this->belongsTo(UserProjectBudget::class, 'user_project_budget_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
