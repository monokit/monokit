<?php

namespace MonoKit\Database\Sql\Manager\Entity;

class SqlLeftJoinTable extends SqlJoinTable
{
    /**
     * @return string
     */
    public function toString()
    {
        if ( $this->getAlias() !== $this->getName() )
            return sprintf("LEFT JOIN %s AS %s ON %s" , $this->getName() , $this->getAlias() , $this->condition );

        return sprintf("LEFT JOIN %s ON %s" , $this->getName() , $this->condition );
    }
}