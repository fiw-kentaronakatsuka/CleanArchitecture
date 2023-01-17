<?php
namespace App\Controllers;

use App\Libraries\Core\Util;
use App\View\View;
use App\Models\UserModel;

use App\CleanArchitecture\EnterpriseBusinessRule\Entities\Entity;
use App\CleanArchitecture\InterfaceAdapter\Controller\Controller;
use App\CleanArchitecture\InterfaceAdapter\Presenter\Presenter;
use App\CleanArchitecture\InterfaceAdapter\Gateway\DataAccess;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\UseCaseInteractor;

class Main extends BaseCOntroller
{
    public function index()
    {
        //  各種インスタンス生成
        $view = new View();
        $userModel = new UserModel;
        $presenter = new Presenter($view);
        $dataAccess = new DataAccess($userModel);
        $entity = new Entity();
        $useCaseInteractor = new UseCaseInteractor($presenter, $dataAccess, $entity);
        $util = new Util();
        $controller = new Controller($useCaseInteractor, $util);
 
        $controller->exec();
    }
}
