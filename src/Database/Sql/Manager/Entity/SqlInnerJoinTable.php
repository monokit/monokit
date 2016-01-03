<?php

namespace MonoKit\Database\Sql\Manager\Entity;

class SqlInnerJoinTable extends SqlJoinTable
{
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