<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

interface DataAccessInterface
{
    public function exec(InputAccessData $inputAccessData): OutputAccessData;
}
