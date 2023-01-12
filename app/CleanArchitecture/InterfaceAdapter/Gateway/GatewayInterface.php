<?php
namespace App\CleanArchitecture\InterfaceAdapter\Gateway;

interface GatewayInterface
{
    public function exec(InputDataModel $inputDataModel): OutputDataModel;
}
