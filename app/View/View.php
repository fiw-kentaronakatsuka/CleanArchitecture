<?php
namespace App\View;

use App\CleanArchitecture\InterfaceAdapter\Presenter\PresenterInterface;
use App\CleanArchitecture\InterfaceAdapter\Presenter\ViewModel;

class View implements PresenterInterface
{
    public function exec(ViewModel $viewModel)
    {
        echo view('view', $viewModel->get());
    }
}