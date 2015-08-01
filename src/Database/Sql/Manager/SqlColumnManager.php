<?php

namespace MonoKit\Database\Sql\Manager;

use MonoKit\Database\Manager\ColumnManager;
use MonoKit\Database\Sql\Manager\Entity\SqlColumn;
use MonoKit\Foundation\Stringable;

class SqlColumnManager extends ColumnManager implements Stringable
{
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