<?php

namespace MonoKit\Component\Database\Sql\Entity;

class SqlRightJoinTable extends SqlJoinTable
{
    /**
     * @return string
     */
    public function toString()
    {
        if ( $this->getAlias() )
            return sprintf("RIGHT JOIN %s AS %s ON %s" , $this->getName() , $this->getAlias() , $this->condition );

        return sprintf("RIGHT JOIN %s ON %s" , $this->getName() , $this->condition );
    }
}