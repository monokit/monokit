<?php

namespace MonoKit\Database\Manager;

use MonoKit\Manager\EntityManager;
use MonoKit\Database\Manager\Entity\Column;

class ColumnManager extends EntityManager
{
    /**
     * @param Column $column
     * @return ColumnManager
     */
    public function add( Column $column )
    {
        return parent::add( $column );
    }

}