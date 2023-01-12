<?php
namespace App\CleanArchitecture\InterfaceAdapter\Gateway;

class OutputDataModel
{
    private array $whereClause;
    private int $limitClause;
    private int $offsetClause;

    public function __construct(array $whereClause, int $limitClause, int $offsetClause)
    {
        $this->whereClause = $whereClause;
        $this->limitClause = $limitClause;
        $this->offsetClause = $offsetClause;
    }

    public function getWhereClause(): array
    {
        return $this->whereClause;
    }

    public function getLimitClause(): int
    {
        return $this->limitClause;
    }

    public function getOffsetClause(): int
    {
        return $this->offsetClause;
    }
}
