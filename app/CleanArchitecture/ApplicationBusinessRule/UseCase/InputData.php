<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

class InputData
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    
    public function getId(): int
    {
        return $this->id;
    }
}
