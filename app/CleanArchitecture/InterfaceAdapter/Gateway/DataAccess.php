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

    public function exec(OutputAccessData $outputAccessData): InputAccessData
    {
        $id = $outputAccessData->getId();
        $retired = $outputAccessData->getRetired();

        //  Model用にSQL作成
        $whereClause = [
            'id' => $id,
            'deleted_at' => $retired,
        ];
        $limitClause = 1;
        $offsetClause = 0;
        $this->outputDataModel = new OutputDataModel($whereClause, $limitClause, $offsetClause);
        $this->inputDataModel = $this->gatewayInterface->exec($this->outputDataModel);

        return new InputAccessData($this->inputDataModel->getId(), $this->inputDataModel->getName(), $this->inputDataModel->getSalary());
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
