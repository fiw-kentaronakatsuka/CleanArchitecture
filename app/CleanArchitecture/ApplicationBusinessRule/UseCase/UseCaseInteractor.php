<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

use App\CleanArchitecture\EnterpriseBusinessRule\Entities\Entity;

class UseCaseInteractor implements InputBoundaryInterface
{
    private OutputBoundaryInterface $outputBoundaryInterface;
    private DataAccessInterface $dataAccessInterface;
    private ?OutputAccessData $outputAccessData;
    private ?InputAccessData $inputAccessData;
    private ?OutputData $outputData;

    public function __construct(
        OutputBoundaryInterface $outputBoundaryInterface,
        DataAccessInterface $dataAccessInterface
        )
    {
        $this->outputBoundaryInterface = $outputBoundaryInterface;
        $this->dataAccessInterface = $dataAccessInterface;
        $this->inputAccessData = null;
        $this->outputAccessData = null;
        $this->outputData = null;
    }

    public function exec(InputData $inputData): void
    {
        $id = $inputData->getId();
        $retired = false;
        $this->inputAccessData = new InputAccessData($id, $retired);
        $this->outputAccessData = $this->dataAccessInterface->exec($this->inputAccessData);

        $entity = new Entity($this->outputAccessData->getId(), $this->outputAccessData->getSalary());
        $name = $this->outputAccessData->getName();
        $salary = $entity->calc();

        $overMillionSalary = false;
        //  100万を超える場合
        if($salary > 1000000) {
            $overMillionSalary = true;
        }

        $this->outputData = new OutputData($name, $salary, $overMillionSalary);
        $this->outputBoundaryInterface->exec($this->outputData);
    }

    public function getInputAccessData(): ?InputAccessData
    {
        return $this->inputAccessData;
    }

    public function getOutputAccessData(): ?OutputAccessData
    {
        return $this->outputAccessData;
    }

    public function getOutputData(): ?OutputData
    {
        return $this->outputData;
    }
}
