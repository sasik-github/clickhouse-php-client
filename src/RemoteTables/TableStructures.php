<?php
namespace ClickHouse\RemoteTables;


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
            'query' => [],
        ];

        /** @var TableStructure $tableStructure */
        foreach ($this->tableStructures as $tableStructure) {
            $options['query'][$tableStructure->getTableName() . '_structure'] = $tableStructure->getTableStructureForQuery();
            $options['multipart'][] = [
                'name' => $tableStructure->getTableName(),
                'contents' => $tableStructure->getContent(),
                'filename' => $tableStructure->getTableName()
            ];
        }

        return $options;
    }


}