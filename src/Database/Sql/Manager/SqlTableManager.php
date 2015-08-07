<?php

namespace MonoKit\Database\Sql\Manager;

use MonoKit\Manager\EntityManager;
use MonoKit\Database\Sql\SqlException;
use MonoKit\Database\Sql\Manager\Entity\SqlTable;

class SqlTableManager extends EntityManager
{
    /**
     * @param SqlTable $table
     * @return SqlTableManager
     */
    public function addTable( SqlTable $table )
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