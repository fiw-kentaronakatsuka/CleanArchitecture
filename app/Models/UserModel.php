<?php
namespace App\Models;

use CodeIgniter\Model;
use App\CleanArchitecture\InterfaceAdapter\Gateway\GatewayInterface;
use App\CleanArchitecture\InterfaceAdapter\Gateway\InputDataModel;
use App\CleanArchitecture\InterfaceAdapter\Gateway\OutputDataModel;

class UserModel extends Model implements GatewayInterface
{
    protected $table = 'users';
    protected $returnType = 'array';

    public function exec(OutputDataModel $outputDataModel): InputDataModel
    {
        $result = $this
            ->where($outputDataModel->getWhereClause())
            ->limit($outputDataModel->getLimitClause())
            ->offset($outputDataModel->getOffsetClause())
        ->findAll()[0];

        return new InputDataModel($result['id'], $result['name'], $result['gender'], $result['age'], $result['salary']);
    }
}