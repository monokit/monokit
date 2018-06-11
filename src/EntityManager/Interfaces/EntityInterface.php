<?php

namespace MonoKit\EntityManager\Interfaces;

use MonoKit\EntityManager\Entity;

Interface EntityInterface
{
    /**
     * @param string $property
     * @param mixed $value
     * @return Entity
     */
    public function set( $property , $value );

    /**
     * @param string $property
     * @return mixed
     */
    public function get( $property );

    /**
     * @return $this
     */
    public function getClone();

    /**
     * @param array $array
     * @return $this
     */
    public function map( array $array );
}