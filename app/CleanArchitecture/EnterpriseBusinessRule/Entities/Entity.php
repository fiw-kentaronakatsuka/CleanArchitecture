<?php
namespace App\CleanArchitecture\EnterpriseBusinessRule\Entities;

class Entity implements EntityInterface
{
    private int $id;
    private int $salary;

    public function __construct()
    {
        $this->id = 0;
        $this->salary = 0;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setSalary(int $salary): void
    {
        $this->salary = $salary;
    }

    public function calc(): int
    {
        return $this->salary * 2;
    }
}