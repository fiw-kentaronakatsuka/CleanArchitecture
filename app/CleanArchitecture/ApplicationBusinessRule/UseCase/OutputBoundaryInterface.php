<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

interface OutputBoundaryInterface
{
    public function exec(OutputData $outputData): void;
}
