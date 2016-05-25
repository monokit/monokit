<?php

namespace MonoKit\EntityManager\Interfaces;

use MonoKit\EntityManager\Entity;
use MonoKit\EntityManager\EntityManager;

interface EntityManagerInterface extends \Iterator
{
    /**
     * @param string $key
     * @param string $value
     * @return EntityManager
     */
    public function find( $key , $value );

    /**
     * @return Entity|null
     */
    public function getFirst();

    /**
     * @return Entity|null
     */
    public function getLast();
}