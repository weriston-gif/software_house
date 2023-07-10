<?php

namespace App\DTO;

class BudgetRegistrationTypeDTO
{
    public $user_project_budget_id;
    public $value_total_page;
    public $type_id;
    public $platform;
    public $page_login;
    public $system_pay;
    public $final_budget_value;
    public $license_access;
    public $printer;
    public $operational_system;
    public $browser_support;

    public function __construct($data, $total_value)
    {
        $this->user_project_budget_id = $data['user_project_budget_id'];
        $this->type_id = $data['type_id'];

        $this->platform = $data['platform'] ?? '0';
        $this->operational_system = $data['operational_system'];
        $this->browser_support = $data['browser_support'];

        $this->page_login = $data['page_login'] ?? false;
        $this->system_pay = $data['system_pay'] ?? false;

        $this->license_access = $data['license_access'] ?? false;
        $this->printer = $data['printer'] ?? false;
      
        $this->value_total_page = $data['value_total_page'];
        $this->final_budget_value = $total_value;

    }

    public function toArray()
    {
        return [
            'user_project_budget_id' => $this->user_project_budget_id,
            'value_total_page' => $this->value_total_page,
            'type_id' => $this->type_id,
            'platform' => $this->platform,
            'page_login' => $this->page_login,
            'system_pay' => $this->system_pay,
            'final_budget_value' => $this->final_budget_value,
            'license_access' => $this->license_access,
            'printer' => $this->printer,
            'operational_system' => $this->operational_system,
            'browser_support' => $this->browser_support,
        ];
    }
}
