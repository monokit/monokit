<?php

namespace MonoKit\Database\Sql\Manager;

use MonoKit\Manager\EntityManager;
use MonoKit\Foundation\Stringable;
use MonoKit\Database\Sql\Manager\Entity\SqlColumn;

class SqlColumnManager extends EntityManager implements Stringable
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
            $arrColumnsName[] = $Column->getProperty("field");

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