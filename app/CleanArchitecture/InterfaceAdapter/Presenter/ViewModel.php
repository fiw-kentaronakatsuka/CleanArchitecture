<?php
namespace App\CleanArchitecture\InterfaceAdapter\Presenter;

class ViewModel
{
    private string $name;
    private int $salary;
    private bool $isHighSalary;

    public function __construct(string $name, int $salary, bool $isHighSalary)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->isHighSalary = $isHighSalary;
    }

    private function getName(): string
    {
        return $this->name;
    }
    
    private function getSalary(): int
    {
        return $this->salary;
    }

    private function getIsHighSalary(): int
    {
        return $this->isHighSalary;
    }

    public function get()
    {
        return [
            'name' => $this->getName(),
            'salary' => $this->getSalary(),
            'isHighSalary' => $this->getIsHighSalary(),
        ];
    }
}
