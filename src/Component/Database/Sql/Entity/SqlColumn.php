<?php

namespace MonoKit\Component\Database\Sql\Entity;

use MonoKit\Component\Database\Entity\Column;
use MonoKit\Foundation\Interfaces\StringInterface;

class SqlColumn extends Column implements StringInterface
{
    /** @var string */
    protected $alias;
    /** @var mixed */
    protected $value;

    public function __construct( $field , $alias = null )
    {
        parent::__construct( $field );
        $this->setAlias( $alias );
    }

    /**
     * @param string $alias
     * @return SqlColumn
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $value
     * @return SqlColumn
     */
    public function setValue( $value = null )
    {
        if ( is_bool( $value ) )
            $value = ( $value === true ) ? "true" : "false";

        if ( is_string( $value ) )
            $value = "'{$value}'";

        if ( is_array( $value ) )
            $value = @implode( "," , $value );

        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->getField();
    }

}