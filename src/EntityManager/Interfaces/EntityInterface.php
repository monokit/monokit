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
     * @param mixed $value
     * @return $this
     */
    public function setId( $value );

    /**
     * @param string $property
     * @return mixed
     */
    public function get( $property );

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return $this
     */
    public function getClone();

    /**
     * @param array $array
     * @return $this
     */
    public function serialize( array $array );
}