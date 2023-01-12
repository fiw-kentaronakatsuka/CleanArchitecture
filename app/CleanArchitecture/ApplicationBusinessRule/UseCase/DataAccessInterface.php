<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

interface DataAccessInterface
{
    public function exec(OutputAccessData $outputAccessData): InputAccessData;
}
