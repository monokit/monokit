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
            $columnName = $this->getAlias().__DOT__.$columnName;

            if ( strpos( $columnName , " AS " ) )
            {
                $columnNameArray = explode( " AS " , $columnName );
                $Column = new SqlColumn( current($columnNameArray)." AS '".end($columnNameArray)."'" );
            } else {
                $Column = new SqlColumn( "{$columnName} AS '{$columnName}'" );
            }

            $this->getColumnManager()->addColumn( $Column );
        }

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        if ( $this->getAlias() )
            return sprintf("INNER JOIN %s AS %s ON %s" , $this->getName() , $this->getAlias() , $this->condition );

        return sprintf("INNER JOIN %s ON %s" , $this->getName() , $this->condition );
    }
}