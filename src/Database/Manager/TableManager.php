<?php

namespace MonoKit\Database\Manager;

use MonoKit\Manager\EntityManager;
use MonoKit\Database\Manager\Entity\Table;

class TableManager extends EntityManager
{
    /**
     * @param Table $table
     * @return TableManager
     */
    public function add( Table $table )
    {
        return parent::add($table);
    }

}