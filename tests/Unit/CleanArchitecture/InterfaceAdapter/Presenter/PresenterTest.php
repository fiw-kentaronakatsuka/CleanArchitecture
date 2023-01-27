<?php

namespace Tests\Unit\CleanArchitecture\InterfaceAdapter\Presenter;

use App\CleanArchitecture\ApplicationBusinessRule\UseCase\OutputData;
use App\CleanArchitecture\InterfaceAdapter\Presenter\Presenter;
use App\CleanArchitecture\InterfaceAdapter\Presenter\ViewModel;
use App\View\View;
use PHPUnit\Framework\TestCase;

class PresenterTest extends TestCase
{
    public function test_exec正常なViewModelを生成されることを確認()
    {
        //  arrange
        $ViewStub = $this->createStub(View::class);
        $presenter = new Presenter($ViewStub);
        $outputData = new OutputData('test_name',1000001, true);

        $name = 'test_name';
        $salary = 1000001;
        $isHighSalary = true;

        $expected = new ViewModel($name, $salary, $isHighSalary);

        //  act
        $presenter->exec($outputData);
        $actual = $presenter->getViewModel();

        //  assert
        $this->assertSame($expected->get(), $actual->get());
    }
}