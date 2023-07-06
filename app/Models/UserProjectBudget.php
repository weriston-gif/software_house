<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProjectBudget extends Model
{
    use HasFactory;

    protected $table = 'user_project_budgets';

    protected $fillable = [
        'name',
        'email',
        'telefone',
        'rua',
        'numero',
        'bairro',
        'cep',
        'complemento',
        'municipio',
        'uf',
        'pais',
    ];

    public function userProjectBudgetType()
    {
        return $this->hasMany(UserProjectBudgetType::class);
    }
}
