<?php

namespace Tests\Unit\CleanArchitecture\ApplicationBusinessRule\UseCase;

use App\CleanArchitecture\ApplicationBusinessRule\UseCase\InputAccessData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\InputData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\OutputAccessData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\OutputData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\UseCaseInteractor;
use App\CleanArchitecture\InterfaceAdapter\Gateway\DataAccess;
use App\CleanArchitecture\InterfaceAdapter\Presenter\Presenter;
use PHPUnit\Framework\TestCase;

class UseCaseInteractorTest extends TestCase
{
    public function test_exec_正常なOutputAccessDataが生成されることを確認()
    {
        //  arrange
        $presenterStub = $this->createStub(Presenter::class);
        $dataAccessStub = $this->createStub(DataAccess::class);

        $useCaseInteractor = new UseCaseInteractor($presenterStub, $dataAccessStub);

        $inputData = new InputData(1);
        $expected = new OutputAccessData(1, false);

        //  act
        $useCaseInteractor->exec($inputData);
        $actual = $useCaseInteractor->getOutputAccessData();

        //  assert
        $this->assertSame($expected->getId(), $actual->getId());
        $this->assertSame($expected->getRetired(), $actual->getRetired());
    }

    public function test_exec_正常なOutputDataが生成されることを確認()
    {
        //  arrange
        $presenterStub = $this->createStub(Presenter::class);
        $dataAccessStub = $this->createStub(DataAccess::class);
        $dataAccessStub->method('exec')
            ->willReturn(new InputAccessData(1, 'test_name', 500001));

        $useCaseInteractor = new UseCaseInteractor($presenterStub, $dataAccessStub);

        $inputData = new InputData(1);
        $expected = new OutputData('test_name', 1000002, true);

        //  act
        $useCaseInteractor->exec($inputData);
        $actual = $useCaseInteractor->getOutputData();

        //  assert
        $this->assertSame($expected->getName(), $actual->getName());
        $this->assertSame($expected->getSalary(), $actual->getSalary());
        $this->assertSame($expected->getOverMillionSalary(), $actual->getOverMillionSalary());
    }
}