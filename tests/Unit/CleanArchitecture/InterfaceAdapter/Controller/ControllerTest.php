<?php

namespace Tests\Unit\CleanArchitecture\InterfaceAdapter\Controller;

use App\CleanArchitecture\ApplicationBusinessRule\UseCase\InputData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\UseCaseInteractor;
use App\CleanArchitecture\InterfaceAdapter\Controller\Controller;
use App\Libraries\Core\Util;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function test_exec_GETパラメータのidに整数値が入る場合に正常なInputDataの値が入ることを確認()
    {
        //  arrange
        $useCaseInteractorStub = $this->createStub(UseCaseInteractor::class);
        $useCaseInteractorStub->method('exec');

        $utilStub = $this->createStub(Util::class);
        $utilStub->method('getGetParam')
            ->willReturn('1');

        $controller = new Controller($useCaseInteractorStub, $utilStub);

        $expected = new InputData(1);

        //  act
        $controller->exec();

        //  assert
        $this->assertSame($expected->getId(), $controller->getInputData()->getId());
    }

    public function test_exec_GETパラメータのidにNULLが入る場合にエラーが表示され、処理が止まることを確認()
    {
        //  arrange
        $useCaseInteractorMock = $this->getMockBuilder(UseCaseInteractor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $useCaseInteractorMock->expects($this->never())
            ->method('exec');

        $utilMock = $this->getMockBuilder(Util::class)
            ->onlyMethods(['getGetParam'])
            ->getMock();

        $utilMock->method('getGetParam')
            ->willReturn(null);

        $controller = new Controller($useCaseInteractorMock, $utilMock);

        $expected = null;

        try {
            //  act
            $controller->exec();
        } catch (\Exception $e) {
            //  assert
            $this->assertSame($expected, $controller->getInputData());
        }
    }
}