<?php

namespace MonoKit\Database\Sql\Manager\Entity;

class SqlLeftJoinTable extends SqlJoinTable
{
    /**
     * @return string
     */
    public function toString()
    {
        return sprintf("LEFT JOIN %s ON %s" , $this->getName() , $this->condition );
    }
}