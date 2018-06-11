<?php

namespace MonoKit\Component\Database\Sql;

use MonoKit\Component\Database\Sql\Entity\SqlTable;
use MonoKit\Component\Database\Sql\Interfaces\SqlInterface;
use MonoKit\EntityManager\Entity;

class SqlInsert extends Sql implements SqlInterface
{
    /**
     * @param string $tableName
     * @param string|null $tableAlias
     */
    public function __construct( $tableName , $tableAlias = null )
    {
        parent::__construct();

        $this->setSqlTable( new SqlTable( $tableName , $tableAlias ) );
    }

    /**
     * @param string $column
     * @param mixed|null $value
     * @param mixed|null $default
     * @return $this
     */
    public function setValue( $column , $value = null , $default = null )
    {
        $value = ( empty($value) || is_null( $value ) ) ? $default : $value;

        if ( $value instanceof Entity )
            $value = $value->get( $column );

        $this->getSqlTable()->setColumnValue( $column , $value );
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $columnValue = array();

        foreach( $this->getSqlTable()->getColumnManager() as $column )
            $columnValue[] = (is_null( $column->getValue() )) ? "{$column->getField()} = NULL" : "{$column->getField()} = {$column->getValue()}";

        return sprintf("INSERT INTO %s SET %s", $this->getSqlTable()->toString(), implode( ", " , $columnValue ) );
    }
}