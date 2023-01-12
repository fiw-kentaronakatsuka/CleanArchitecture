<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

class OutputData
{
    private string $name;
    private int $salary;
    private bool $overMillionSalary;

    public function __construct(string $name, int $salary, bool $overMillionSalary)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->overMillionSalary = $overMillionSalary;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getSalary(): int
    {
        return $this->salary;
    }

    public function getOverMillionSalary(): bool
    {
        return $this->overMillionSalary;
    }
}
