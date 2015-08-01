<?php

namespace MonoKit\Database\Sql\Command;

use MonoKit\Foundation\Foundation;
use MonoKit\Database\Sql\SqlInterface;
use MonoKit\Database\Sql\Manager\SqlTableManager;
use MonoKit\Database\Sql\Manager\Entity\SqlTable;
use MonoKit\Database\Sql\Manager\Entity\SqlLeftJoinTable;
use MonoKit\Database\Sql\Manager\Entity\SqlRightJoinTable;

class SqlUpdate extends Foundation implements SqlInterface
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
     * @param string $condition
     * @return SqlSelect
     */
    public function where($condition)
    {
        $this->table->setCondition($this->table->getAlias() . __DOT__ . $condition);
        return $this;
    }


    /**
     * @return string
     */
    public function toString()
    {
        $columValue = array();

        foreach( $this->table->getColumnManager() as $column )
            $columValue[] = (is_null( $column->getValue() )) ? "{$column->getField()} = NULL" : "{$column->getField()} = {$column->getValue()}";

        return sprintf("UPDATE %s SET %s %s",    $this->table->toString(),
                                                 implode( ", " , $columValue ) ,
                                                 $this->table->getCondition() );

    }
}
