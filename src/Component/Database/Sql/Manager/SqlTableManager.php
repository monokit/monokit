<?php

namespace MonoKit\Component\Database\Sql\Manager;

use MonoKit\EntityManager\EntityManager;
use MonoKit\Component\Database\Sql\Entity\SqlTable;
use MonoKit\Component\Database\Sql\Exception\SqlException;

class SqlTableManager extends EntityManager
{
    /**
     * @param SqlTable $sqlTable
     * @return SqlTableManager
     */
    public function add( SqlTable $sqlTable )
    {
        return parent::add( $sqlTable );
    }

    /**
     * @param string $tableName
     * @return SqlTable
     * @throws SqlException
     */
    public function getSqlTableByName( $tableName )
    {
        if ( !$table = $this->find( "name" , $tableName ) )
            throw new SqlException("Le nom de la table <STRONG>$tableName</STRONG> est introuvable..." , $this );

        return $table[0];
    }

}