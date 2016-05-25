<?php

namespace MonoKit\Component\Database\Sql\Manager;

use MonoKit\EntityManager\EntityManager;
use MonoKit\Foundation\Interfaces\StringInterface;
use MonoKit\Component\Database\Sql\Entity\SqlColumn;

class SqlColumnManager extends EntityManager implements StringInterface
{
    /**
     * @param SqlColumn $sqlColumn
     * @return SqlColumnManager
     */
    public function addColumn( SqlColumn $sqlColumn )
    {
        return parent::add( $sqlColumn );
    }

    /**
     * @return string
     */
    public function toString()
    {
        $arrColumnsName = array();

        foreach( $this AS $Column )
            $arrColumnsName[] = $Column->getField();

        return ( $arrColumnsName ) ? implode( ", " , $arrColumnsName ) : "*";
    }

    /**
     * @return SqlColumn
     */
    public function current()
    {
        return parent::current();
    }

}