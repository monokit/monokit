<?php

namespace MonoKit\Component\Database\Sql;

class SqlUpdate extends SqlInsert
{
    /**
     * @param string $column
     * @param mixed|null $value
     * @param mixed|null $default
     * @return SqlUpdate
     */
    public function setValue( $column , $value = null , $default = null )
    {
        $value = ( empty($value) || is_null( $value ) ) ? $default : $value;

        $this->getSqlTable()->setColumnValue( $column , $value );
        return $this;
    }

    /**
     * @param string $condition
     * @param bool|true $autoAlias
     * @return SqlUpdate
     */
    public function where( $condition , $autoAlias = true )
    {
        if ( $autoAlias )
        {
            $this->getSqlTable()->setCondition( $this->getSqlTable()->getAlias() . __DOT__ . $condition );
        } else {
            $this->getSqlTable()->setCondition( $condition );
        }

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $columnValue = array();

        foreach( $this->getSqlTable()->getColumnManager() as $column )
            $columnValue[] = (is_null( $column->getValue() )) ? "{$column->getField()} = NULL" : "{$column->getField()} = {$this->preventDoubleQuote($column->getValue())}";

        return sprintf("UPDATE %s SET %s %s",    $this->getSqlTable()->toString(),
                                                 implode( ", " , $columnValue ) ,
                                                 $this->getSqlTable()->getCondition() );
    }
}
