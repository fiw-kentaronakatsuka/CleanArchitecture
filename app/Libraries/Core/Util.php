<?php

namespace App\Libraries\Core;

use App\CleanArchitecture\Core\UtilInterface;

class Util implements UtilInterface
{
    public function getGetParam(string $getParameter): ?string
    {
        $request = \Config\Services::request();
        return $request->getGet($getParameter);
    }

    public function somethingError(): void
    {
        throw new \ErrorException();
    }
}
