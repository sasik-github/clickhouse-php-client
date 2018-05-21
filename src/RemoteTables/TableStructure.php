<?php
namespace App\Common\ClickHouse\Utils;


class TableStructure
{

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var array
     */
    private $fields = [];

    private $tableContent = null;

    /**
     * TableStructure constructor.
     * @param $tableName
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    public function clearAllFields()
    {
        $this->fields = [];
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    public function addContentToTableByUrl($url)
    {
        $this->tableContent = file_get_contents($url);
    }

    /**
     * @return string
     */
    public function getTableStructureForQuery()
    {
        return implode(',', array_map(function (Field $field) {
            return $field->getName() . ' ' . $field->getType();
        }, $this->fields));
    }

    public function getContent()
    {
        return $this->tableContent;
    }


}