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

    public function exec(InputDataModel $inputDataModel): OutputDataModel
    {
        $result = $this
            ->where($inputDataModel->getWhereClause())
            ->limit($inputDataModel->getLimitClause())
            ->offset($inputDataModel->getOffsetClause())
        ->findAll()[0];

        return new OutputDataModel($result['id'], $result['name'], $result['gender'], $result['age'], $result['salary']);
    }
}