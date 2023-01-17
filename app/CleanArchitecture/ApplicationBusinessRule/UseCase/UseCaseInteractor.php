<?php
namespace App\CleanArchitecture\ApplicationBusinessRule\UseCase;

use App\CleanArchitecture\EnterpriseBusinessRule\Entities\EntityInterface;

class UseCaseInteractor implements InputBoundaryInterface
{
    private OutputBoundaryInterface $outputBoundaryInterface;
    private DataAccessInterface $dataAccessInterface;
    private EntityInterface $entityInterface;
    private ?OutputAccessData $outputAccessData;
    private ?InputAccessData $inputAccessData;
    private ?OutputData $outputData;

    public function __construct(
        OutputBoundaryInterface $outputBoundaryInterface,
        DataAccessInterface $dataAccessInterface,
        EntityInterface $entityInterface
        )
    {
        $this->outputBoundaryInterface = $outputBoundaryInterface;
        $this->dataAccessInterface = $dataAccessInterface;
        $this->entityInterface = $entityInterface;
        $this->inputAccessData = null;
        $this->outputAccessData = null;
        $this->outputData = null;
    }

    public function exec(InputData $inputData): void
    {
        $id = $inputData->getId();
        $retired = false;
        $this->outputAccessData = new OutputAccessData($id, $retired);
        $this->inputAccessData = $this->dataAccessInterface->exec($this->outputAccessData);

        $this->entityInterface->setId($this->inputAccessData->getId());
        $this->entityInterface->setSalary($this->inputAccessData->getSalary());

        $salary = $this->entityInterface->calc();
        $name = $this->inputAccessData->getName();

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
