<?php
namespace App\Common\ClickHouse\Utils;


class TableStructures
{
    private $tableStructures = [];

    public function addTableStructure(TableStructure $tableStructure)
    {
        $this->tableStructures[] = $tableStructure;
    }

    public function clearTableStructures()
    {
        $this->tableStructures = [];
    }

    public function getTableStructuresOptions()
    {

        $options = [
            'multipart' => [],
        ];
        /** @var TableStructure $tableStructure */
        foreach ($this->tableStructures as $tableStructure) {
            $options[$tableStructure->getTableName() . '_structure'] = $tableStructure->getTableStructureForQuery();
            $options['multipart'][] = [
                'name' => $tableStructure->getTableName(),
                'contents' => $tableStructure->getContent(),
                'filename' => $tableStructure->getTableName()
            ];
        }

        return $options;
    }

}