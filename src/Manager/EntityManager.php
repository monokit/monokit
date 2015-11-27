<?php

namespace MonoKit\Manager;

use MonoKit\Foundation\Foundation;
use MonoKit\Foundation\Arrayable;
use MonoKit\Foundation\Stringable;

Abstract class EntityManager extends Foundation implements \Iterator, \Countable, Arrayable
{
    /** @var int */
    private $index = 0;
    /** @var array */
    private $source;

    /**
     * @param array $source
     */
    public function __construct( array $source = array() )
    {
        $this->set( $source );
    }

    /**
     * @param EntityInterface $entity
     * @return EntityManager
     */
    protected function add( EntityInterface $entity )
    {
        $this->source[] = $entity;
        return $this;
    }

    /**
     * @param array $entities
     * @return EntityManager
     */
    protected function set( array $entities = array() )
    {
        foreach( $entities as $entity )
            $this->add( $entity );

        return $this;
    }

    /**
     * Retourne un [ Entity ] en fonction de la valeur d'une propriété
     *
     * @example $myManager->find( "id" , 1234 );
     * @param string $entityProperty
     * @param mixed $value
     * @return array|null
     */
    protected function find( $entityProperty , $value )
    {
        $output = array();

        foreach( $this as $entity )
            if ( $entity->getProperty( $entityProperty ) == $value )
                $output[] = $entity;

        return ( $output ) ? $output : null;
    }

    /**
     * @return EntityManager
     */
    protected function removeAll()
    {
        $this->source = array();
        $this->index = 0;
        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function first()
    {
        return ( isset( $this->source[0] ) ) ? $this->source[0] : null;
    }

    /**
     * Return the current element
     * @return EntityInterface
     */
    public function current()
    {
        return $this->source[ $this->index ];
    }

    /**
     * Move forward to next element
     * @return void
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * Return the key of the current element
     * @return mixed.
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * Checks if current position is valid
     * @return boolean The return value will be casted to boolean and then evaluated.
     */
    public function valid()
    {
        return isset( $this->source[ $this->index ] );
    }

    /**
     * Rewind the Iterator to the first element
     * @return void
     */
    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * Count elements of an object
     * @return int The custom count as an integer.
     */
    public function count()
    {
        return count( $this->source );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->source;
    }
}