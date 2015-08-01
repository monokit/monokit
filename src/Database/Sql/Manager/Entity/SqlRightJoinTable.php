<?php

namespace MonoKit\Database\Sql\Manager\Entity;

class SqlRightJoinTable extends SqlJoinTable
{
    /**
     * @return string
     */
    public function toString()
    {
        return sprintf("RIGHT JOIN %s ON %s" , $this->getName() , $this->condition );
    }
}