<?php

namespace MonoKit\Database\Sql\Manager\Entity;

use MonoKit\Database\Manager\Entity\Column;
use MonoKit\Foundation\Stringable;

class SqlColumn extends Column implements Stringable
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
     * @param $value
     * @return SqlColumn
     */
    public function setValue( $value = null )
    {
        if ( is_string( $value ) )
            $value = "'{$value}'";

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