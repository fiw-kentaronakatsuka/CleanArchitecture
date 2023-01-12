<?php
namespace App\CleanArchitecture\InterfaceAdapter\Gateway;

use App\CleanArchitecture\ApplicationBusinessRule\UseCase\InputAccessData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\OutputAccessData;
use App\CleanArchitecture\ApplicationBusinessRule\UseCase\DataAccessInterface;

class DataAccess implements DataAccessInterface
{
    private GatewayInterface $gatewayInterface;
    private ?InputDataModel $inputDataModel;
    private ?OutputDataModel $outputDataModel;

    public function __construct(GatewayInterface $gatewayInterface)
    {
        $this->gatewayInterface = $gatewayInterface;
        $this->inputDataModel = null;
        $this->outputDataModel = null;
    }

    public function exec(InputAccessData $inputAccessData): OutputAccessData
    {
        $id = $inputAccessData->getId();
        $retired = $inputAccessData->getRetired();

        //  Model用にSQL作成
        $whereClause = [
            'id' => $id,
            'deleted_at' => $retired,
        ];
        $limitClause = 1;
        $offsetClause = 0;
        $this->inputDataModel = new InputDataModel($whereClause, $limitClause, $offsetClause);
        $this->outputDataModel = $this->gatewayInterface->exec($this->inputDataModel);

        return new OutputAccessData($this->outputDataModel->getId(), $this->outputDataModel->getName(), $this->outputDataModel->getSalary());
    }

    public function getInputDataModel(): ?InputDataModel
    {
        return $this->inputDataModel;
    }

    public function getOutputDataModel(): ?OutputDataModel
    {
        return $this->outputDataModel;
    }
}
