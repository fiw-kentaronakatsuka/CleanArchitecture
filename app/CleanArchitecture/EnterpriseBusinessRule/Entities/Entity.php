<?php
namespace App\CleanArchitecture\EnterpriseBusinessRule\Entities;

class Entity
{
    private int $id;
    private int $salary;

    public function __construct(int $id ,int $salary)
    {
        $this->id = $id;
        $this->salary = $salary;
    }

    public function calc(): int
    {
        return $this->salary * 2;
    }
}