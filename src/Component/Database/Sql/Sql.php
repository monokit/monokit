<?php

namespace MonoKit\Component\Database\Sql;

use MonoKit\Component\Database\Sql\Entity\SqlTable;
use MonoKit\EntityManager\Entity;

use MonoKit\Component\Database\Sql\Interfaces\SqlInterface;

class Sql extends Entity implements SqlInterface
{
    /** @var string */
    protected $sql;
    /** @var SqlTable */
    protected $SqlTable;

    /**
     * @param string $sql
     */
    public function __construct( $sql = null )
    {
        if ( !is_null( $sql ) )
            $this->setSql( $sql );
    }

    /**
     * @param string $sql
     * @return $this
     */
    public function setSql( $sql )
    {
        $this->sql = $sql;
        return $this;
    }

    /**
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @param SqlTable $sqlTable
     * @return SqlUpdate
     */
    protected function setSqlTable( SqlTable $sqlTable )
    {
        $this->SqlTable = $sqlTable;
        return $this;
    }

    /**
     * @return SqlTable
     */
    protected function getSqlTable()
    {
        return $this->SqlTable;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->getSql();
    }
}