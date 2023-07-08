<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserProjectBudget extends Model
{
    use HasFactory , HasUuids;

 

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
