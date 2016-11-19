<?php

namespace MonoKit\Component\Database\Entity;

use MonoKit\EntityManager\Entity;

class Table extends Entity
{
    /** @var string */
    protected $name;

    /**
     * Table constructor.
     * @param null|string $name
     */
    public function __construct( $name = null )
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