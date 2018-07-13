<?php

namespace MonoKit\Http;

use MonoKit\EntityManager\Entity;

Class Header extends Entity
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $value;

    /**
     * Header constructor.
     * @param string $name
     * @param mixed $value
     */
    public function __construct( $name , $value = null )
    {
        $this->setName( $name );
        $this->setValue( $value );
    }

    /**
     * @param string $name
     * @return Header
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

    /**
     * @param string $value
     * @return Header
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}