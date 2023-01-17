<?php
namespace App\CleanArchitecture\EnterpriseBusinessRule\Entities;

interface EntityInterface
{
    public function setId(int $id): void;
    public function setSalary(int $salary): void;
    public function calc(): int;
}