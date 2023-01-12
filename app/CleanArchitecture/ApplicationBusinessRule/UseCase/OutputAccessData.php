<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

class OutputAccessData
{
    private int $id;
    private string $name;
    private int $salary;

    public function __construct(int $id, string $name, int $salary)
    {
        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }
}
