<?php

namespace MonoKit\Component\Database\Entity;

use MonoKit\EntityManager\Entity;
use MonoKit\Component\Database\Interfaces\DatabaseInterface;

Class Database extends Entity implements DatabaseInterface
{
    /** @var string */
    protected $name;

    /**
     * Database constructor.
     * @param null|string $name
     */
    public function __construct( $name = null )
    {
        $this->setName( $name );
    }

    /**
     * @param string $name
     * @return Database
     */
    public function setName($name)
    {
        $this->name = $name;
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