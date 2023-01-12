<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

class OutputAccessData
{
    private int $id;
    private bool $retired;

    public function __construct(int $id, bool $retired)
    {
        $this->id = $id;
        $this->retired = $retired;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getRetired(): bool
    {
        return $this->retired;
    }
}
