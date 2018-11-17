<?php

namespace MonoKit\Component\Database\Sql\Entity;

class SqlJoinTable extends SqlTable
{
    /**
     * @param array $columnNames
     * @param bool $autoAlias
     * @return SqlJoinTable
     */
    public function setColumns( array $columnNames , $autoAlias = true )
    {
        foreach( $columnNames AS $columnName )
        {
            if ( $autoAlias )
                $columnName = $this->getAlias().__DOT__.$columnName;

            if ( strpos( $columnName , " AS " ) )
            {
                $columnNameArray = explode( " AS " , $columnName , 2 );
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