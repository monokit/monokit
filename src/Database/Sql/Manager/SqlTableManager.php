<?php

namespace MonoKit\Database\Sql\Manager;

use MonoKit\Database\Sql\Manager\Entity\SqlTable;
use MonoKit\Database\Manager\TableManager;
use MonoKit\Database\Sql\SqlException;

class SqlTableManager extends TableManager
{
    /**
     * @param SqlTable $table
     * @return TableManager
     */
    public function add( SqlTable $table )
    {
        return parent::add( $table );
    }

    /**
     * @param string $tableName
     * @return SqlTable
     * @throws SqlException
     */
    public function getTableByName( $tableName )
    {
        if ( !$table = $this->find( "name" , $tableName ) )
            throw new SqlException("Le nom de la table <STRONG>$tableName</STRONG> est introuvable..." , $this );

        return $table[0];
    }

    /**
     * @return SqlTable
     */
    public function current()
    {
        return parent::current();
    }

}