<?php
namespace App\CleanArchitecture\InterfaceAdapter\Presenter;

use App\CleanArchitecture\ApplicationBusinessRule\UseCase\OutputBoundaryInterface;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\OutputData;

class Presenter implements OutputBoundaryInterface
{
    private PresenterInterface $view;
    private ?ViewModel $viewModel;

    public function __construct(PresenterInterface $view)
    {
        $this->view = $view;
        $this->viewModel = null;

    }

    public function exec(OutputData $outputData): void
    {
        $name = $outputData->getName();
        $salary = $outputData->getSalary();
        $isHighSalary = $outputData->getOverMillionSalary();

        $this->viewModel = new ViewModel($name, $salary, $isHighSalary);

        $this->view->exec($this->viewModel);
    }

    public function getViewModel(): ?ViewModel
    {
        return $this->viewModel;
    }
}
