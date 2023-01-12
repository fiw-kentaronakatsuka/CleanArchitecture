<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

interface InputBoundaryInterface
{
    public function exec(InputData $inputData): void;
}
