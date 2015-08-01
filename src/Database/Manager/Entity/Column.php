<?php

namespace MonoKit\Database\Manager\Entity;

use MonoKit\Manager\Entity;

class Column extends Entity
{
    /** @var string */
    protected $field;
    /** @var string */
    protected $type;

    public function __construct( $field )
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