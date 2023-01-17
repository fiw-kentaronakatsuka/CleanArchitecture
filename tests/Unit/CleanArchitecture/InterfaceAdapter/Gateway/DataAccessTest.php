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
    public function test_exec_正常なOutputDataModelが生成されることを確認する()
    {
        //  arrange

        //  モデルからの戻り値固定
        $userModelStub = $this->createStub(UserModel::class);
        $userModelStub->method('exec')
            ->willReturn(new InputDataModel(1,'test_name',1, 20, 200000));

        $dataAccess = new DataAccess($userModelStub);
        $outputAccessData = new OutputAccessData(1, false);

        $whereClause = [
            'id' => 1,
            'deleted_at' => false,
        ];
        $limitClause = 1;
        $offsetClause = 0;
        $expected = new OutputDataModel($whereClause, $limitClause, $offsetClause);

        //  act
        $dataAccess->exec($outputAccessData);
        $actual = $dataAccess->getOutputDataModel();

            //  assert
        $this->assertSame($expected->getWhereClause(), $actual->getWhereClause());
        $this->assertSame($expected->getLimitClause(), $actual->getLimitClause());
        $this->assertSame($expected->getOffsetClause(), $actual->getOffsetClause());
    }

    public function test_exec_正常なInputAccessDataが返ることを確認する()
    {
        //  arrange

        //  モデルからの戻り値固定
        $userModelStub = $this->createStub(UserModel::class);
        $userModelStub->method('exec')
            ->willReturn(new InputDataModel(1,'test_name',1,20,200000));

        $dataAccess = new DataAccess($userModelStub);

        $inputAccessId = 1;
        $retired = false;
        $outputAccessData = new OutputAccessData($inputAccessId, $retired);

        $expected = new InputAccessData(1, 'test_name', 200000);

        //  act
        $actual = $dataAccess->exec($outputAccessData);

        //  assert
        $this->assertSame($expected->getId(), $actual->getId());
        $this->assertSame($expected->getName(), $actual->getName());
        $this->assertSame($expected->getSalary() ,$actual->getSalary());
    }
}