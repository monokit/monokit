<?php

namespace MonoKit\Database\Sql;

use MonoKit\Foundation\Foundation;
use MonoKit\Database\Sql\Command\SqlSelect;
use MonoKit\Database\Sql\Command\SqlUpdate;

class Sql extends Foundation implements SqlInterface
{
    /** @var string */
    protected $sql;
    /** @var SqlInterface */
    protected $command;

    /**
     * @param string|null $sql
     */
    public function __construct( $sql = null )
    {
        if ( !is_null( $sql ) )
            $this->sql = $sql;
    }

    /**
     * @param string $table
     * @param string|null $tableAlias
     * @return SqlInterface
     */
    public function select( $table , $tableAlias = null)
    {
        return $this->command = new SqlSelect( $table , $tableAlias );
    }

    /**
     * @param string $table
     * @param string|null $tableAlias
     * @return SqlInterface
     */
    public function update( $table , $tableAlias = null)
    {
        return $this->command = new SqlUpdate( $table , $tableAlias );
    }

    /**
     * @return string
     */
    public function toString()
    {
        if ( $this->command )
            return $this->command->toString();

        return $this->sql;
    }
}