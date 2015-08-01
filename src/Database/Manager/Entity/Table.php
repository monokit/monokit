<?php

namespace MonoKit\Database\Manager\Entity;

use MonoKit\Manager\Entity;
use MonoKit\Database\Manager\ColumnManager;

class Table extends Entity
{
    /** @var string */
    protected $name;
    /** @var ColumnManager */
    protected $ColumnManager;

    public function __construct( $name )
    {
        $this->setName( $name );
    }

    /**
     * @param string $value
     * @return Table
     */
    public function setName( $value )
    {
        $this->name = trim( $value );
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param ColumnManager $columnManager
     * @return Table
     */
    public function setColumnManager( ColumnManager $columnManager )
    {
        $this->ColumnManager = $columnManager;
        return $this;
    }

    /**
     * @return ColumnManager
     */
    public function getColumnManager()
    {
        if ( !$this->ColumnManager )
            $this->ColumnManager = new ColumnManager();

        return $this->ColumnManager;
    }

}