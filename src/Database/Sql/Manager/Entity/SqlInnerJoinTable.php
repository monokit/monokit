<?php

namespace MonoKit\Database\Sql\Manager\Entity;

class SqlInnerJoinTable extends SqlJoinTable
{
    /**
     * @return string
     */
    public function toString()
    {
        return sprintf("INNER JOIN %s ON %s" , $this->getName() , $this->condition );
    }
}