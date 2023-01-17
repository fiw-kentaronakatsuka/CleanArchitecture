<?php

namespace Tests\Unit\CleanArchitecture\InterfaceAdapter\Gateway;

use App\CleanArchitecture\ApplicationBusinessRule\UseCase\InputAccessData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\OutputAccessData;
use App\CleanArchitecture\InterfaceAdapter\Gateway\DataAccess;
use App\CleanArchitecture\InterfaceAdapter\Gateway\InputDataModel;
use App\CleanArchitecture\InterfaceAdapter\Gateway\OutputDataModel;
use App\Models\UserModel;
use PHPUnit\Framework\TestCase;

class DataAccessTest extends TestCase
{
    public function test_exec_正常なInputDataModelが生成されることを確認する()
    {
        //  arrange

        //  モデルからの戻り値固定
        $userModelStub = $this->createStub(UserModel::class);
        $userModelStub->method('exec')
            ->willReturn(new OutputDataModel(1,'test_name',1,20,200000));

        $inputAccessData = new InputAccessData(1, false);
        $dataAccess = new DataAccess($userModelStub);

        $whereClause = [
            'id' => 1,
            'deleted_at' => false,
        ];
        $limitClause = 1;
        $offsetClause = 0;
        $expected = new InputDataModel($whereClause, $limitClause, $offsetClause);

        //  act
        $dataAccess->exec($inputAccessData);
        $actual = $dataAccess->getInputDataModel();

            //  assert
        $this->assertSame($expected->getWhereClause(), $actual->getWhereClause());
        $this->assertSame($expected->getLimitClause(), $actual->getLimitClause());
        $this->assertSame($expected->getOffsetClause(), $actual->getOffsetClause());
    }

    public function test_exec_正常なOutputAccessDataが返ることを確認する()
    {
        //  arrange

        //  モデルからの戻り値固定
        $userModelStub = $this->createStub(UserModel::class);
        $userModelStub->method('exec')
            ->willReturn(new OutputDataModel(1,'test_name',1,20,200000));

        $inputAccessId = 1;
        $retired = false;
        $inputAccessData = new InputAccessData($inputAccessId, $retired);
        $dataAccess = new DataAccess($userModelStub);

        $expected = new OutputAccessData(1, 'test_name', 200000);

        //  act
        $actual = $dataAccess->exec($inputAccessData);

        //  assert
        $this->assertSame($expected->getId(), $actual->getId());
        $this->assertSame($expected->getName(), $actual->getName());
        $this->assertSame($expected->getSalary() ,$actual->getSalary());
    }
}