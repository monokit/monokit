<?php

namespace MonoKit\Component\Counter;

use MonoKit\EntityManager\Entity;

Class Counter extends Entity
{
    /** @var int */
    protected $value = 0;
    /** @var int */
    protected $maximum = 0;
    /** @var int */
    protected $minimum = 0;

    /**
     * @param int $value
     * @return Counter
     */
    public function setValue( $value = 0 )
    {
        $value = ( $value < $this->getMin() ) ? $this->getMin() : $value;
        $value = ( $value > $this->getMax() ) ? $this->getMax() : $value;

        $this->value = (int) $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Counter
     */
    public function setMax( $value )
    {
        $this->maximum = (int) $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->maximum;
    }

    /**
     * @return bool
     */
    public function isMax()
    {
        return ( $this->value == $this->getMax() ) ? true : false;
    }

    /**
     * @param $value
     * @return Counter
     */
    public function setMin( $value )
    {
        $this->minimum = (int) $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->minimum;
    }

    /**
     * @return bool
     */
    public function isMin()
    {
        return ( $this->value == $this->getMin() ) ? true : false;
    }

    /**
     * @return Counter
     */
    public function reset()
    {
        $this->setValue( 0 );
        return $this;
    }

}