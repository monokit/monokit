<?php

namespace MonoKit\Database\Sql\Command;

use MonoKit\Foundation\Foundation;
use MonoKit\Database\Sql\SqlInterface;
use MonoKit\Database\Sql\Manager\SqlTableManager;
use MonoKit\Database\Sql\Manager\Entity\SqlTable;

class SqlInsert extends Foundation implements SqlInterface
{
    /** @var SqlTable */
    protected $table;
    /** @var SqlTableManager */
    protected $JoinTableManager;

    /**
     * @param string $tableName
     * @param string|null $tableAlias
     */
    public function __construct($tableName, $tableAlias = null)
    {
        $this->table = new SqlTable($tableName, $tableAlias);
        $this->JoinTableManager = new SqlTableManager();
    }

    /**
     * @param string $column
     * @param mixed|null $value
     * @param mixed|null $default
     * @return SqlUpdate
     */
    public function setValue( $column , $value = null , $default = null )
    {
        $value = ( empty($value) || is_null( $value ) ) ? $default : $value;

        $this->table->setColumnValue( $column , $value );
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $columnValue = array();

        foreach( $this->table->getColumnManager() as $column )
            $columnValue[] = (is_null( $column->getValue() )) ? "{$column->getField()} = NULL" : "{$column->getField()} = {$column->getValue()}";

        return sprintf("INSERT INTO %s SET %s", $this->table->toString(), implode( ", " , $columnValue ) );
    }
}