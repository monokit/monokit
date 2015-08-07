<?php

namespace MonoKit\Database\Sql\Manager\Entity;

use MonoKit\Foundation\Stringable;

class SqlJoinTable extends SqlTable implements Stringable
{
    /**
     * @param array $columnsName
     * @return SqlTable
     */
    public function setColumns( array $columnsName )
    {
        foreach( $columnsName AS $columnName )
        {
            $Column = new SqlColumn( $this->getAlias().__DOT__.$columnName." AS '".$this->getAlias().__DOT__.$columnName."'" );

            $this->getColumnManager()->addColumn( $Column );
        }

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return sprintf("INNER JOIN %s ON %s" , $this->getName() , $this->condition );
    }
}