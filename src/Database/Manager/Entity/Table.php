<?php

namespace MonoKit\Database\Manager\Entity;

use MonoKit\Manager\Entity;

class Table extends Entity
{
    /** @var string */
    protected $name;

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

}