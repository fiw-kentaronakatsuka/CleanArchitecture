<?php
namespace App\CleanArchitecture\InterfaceAdapter\Controller;

use App\CleanArchitecture\ApplicationBusinessRule\UseCase\InputBoundaryInterface;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\InputData;
use App\CleanArchitecture\Core\UtilInterface;

class Controller
{
    private InputBoundaryInterface $useCase;
    private UtilInterface $utilInterface;
    private ?InputData $inputData;

    public function __construct(InputBoundaryInterface $useCase, UtilInterface $utilInterface)
    {
        $this->useCase = $useCase;
        $this->utilInterface = $utilInterface;
        $this->inputData = null;
    }

    public function exec(): void
    {
        $id = $this->utilInterface->getGetParam('id');
        if(is_null($id)) {
            $this->utilInterface->somethingError();
        }

        $this->inputData = new InputData($id);
        $this->useCase->exec($this->inputData);
    }

    public function getInputData(): ?InputData
    {
        return $this->inputData;
    }
}
