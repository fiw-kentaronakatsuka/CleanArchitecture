<?php

namespace App\CleanArchitecture\Core;

interface UtilInterface
{
    public function getGetParam(string $getParameter): ?string;
    public function somethingError(): void;
}
