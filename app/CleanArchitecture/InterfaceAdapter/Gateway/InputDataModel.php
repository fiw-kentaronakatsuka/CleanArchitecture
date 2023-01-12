<?php
namespace App\CleanArchitecture\InterfaceAdapter\Gateway;

class InputDataModel
{
    private int $id;
    private string $name;
    private int $gender;
    private int $age;
    private int $salary;

    public function __construct(int $id, string $name, int $gender, int $age, int $salary)
    {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
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

    public function getGender(): int
    {
        return $this->gender;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }
}
