<?php

namespace App\DTO;

class BudgetRegistrationTypeUpdateDTO
{
    public $name;
    public $email;
    public $telefone;
    public $cep;
    public $rua;
    public $numero;
    public $bairro;
    public $complemento;
    public $municipio;
    public $uf;
    public $pais;
    public $operational_system;
    public $browser_support;
    public $platform;
    public $value_total_page;
    public $printer;
    public $page_login;
    public $license_access;
    public $system_pay;
    public $user_project_budget_types_id;
    public $user_project_budget_id;
    public $type_id;

    public $final_budget_value;

    public function __construct($data, $final_budget_value)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->telefone = $data['telefone'];
        $this->cep = $data['cep'];
        $this->rua = $data['rua'];
        $this->numero = $data['numero'];
        $this->bairro = $data['bairro'];
        $this->complemento = $data['complemento'];
        $this->municipio = $data['municipio'];
        $this->uf = $data['uf'];
        $this->pais = $data['pais'];
        $this->operational_system = $data['operational_system'] ?? '0';
        $this->browser_support = $data['browser_support'] ?? '0';
        $this->platform = $data['platform'] ?? '0';
        $this->value_total_page = $data['value_total_page'];
        $this->printer = $data['printer'] ?? false;
        $this->page_login = $data['page_login'] ?? false;
        $this->license_access = $data['license_access'] ?? false;
        $this->system_pay = $data['system_pay'] ?? false;
        $this->user_project_budget_id = $data['user_project_budget_id'];
        $this->user_project_budget_types_id = $data['user_project_budget_type_id'];
        $this->type_id = $data['type_id'];
        $this->final_budget_value = $final_budget_value;


        
    }


    public function getUserPersonaData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'cep' => $this->cep,
            'rua' => $this->rua,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'complemento' => $this->complemento,
            'municipio' => $this->municipio,
            'uf' => $this->uf,
            'pais' => $this->pais,
        ];
    }
    

    public function getUserTypesData()
    {
        return [
            'final_budget_value' => $this->final_budget_value,
            'value_total_page' => $this->value_total_page,
            'type_id' => $this->type_id,
            'platform' => $this->platform,
            'page_login' => $this->page_login,
            'system_pay' => $this->system_pay,
            'license_access' => $this->license_access,
            'printer' => $this->printer,
            'operational_system' => $this->operational_system,
            'browser_support' => $this->browser_support,
            'user_project_budget_id' => $this->user_project_budget_id
        ];
    }
    


    
}
