<?php

namespace MonoKit\Component\Database\Entity;

use MonoKit\EntityManager\Entity;

class Column extends Entity
{
    /** @var string */
    protected $field;
    /** @var string */
    protected $type;

    /**
     * Column constructor.
     * @param null|string $field
     */
    public function __construct( $field = null )
    {
        $this->setField( $field );
    }

    /**
     * @param string $value
     * @return Column
     */
    public function setField( $value )
    {
        $this->field = trim( $value );
        return $this;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $value
     * @return Column
     */
    public function setType( $value )
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

}