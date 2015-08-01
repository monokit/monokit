<?php

namespace MonoKit\Database\Sql\Manager;

use MonoKit\Foundation\StringableInterface;
use MonoKit\Database\Manager\ColumnManager;
use MonoKit\Database\Sql\Manager\Entity\SqlColumn;

class SqlColumnManager extends ColumnManager implements StringableInterface
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