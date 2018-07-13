<?php

namespace MonoKit\EntityManager;

use MonoKit\EntityManager\Interfaces\EntityInterface;
use MonoKit\EntityManager\Interfaces\EntityManagerInterface;
use MonoKit\Foundation\Interfaces\ArrayInterface;
use MonoKit\Foundation\Interfaces\CountInterface;

Class EntityManager extends Entity implements EntityManagerInterface, ArrayInterface , CountInterface
{
    /** @var int */
    private $index = 0;
    /** @var array */
    protected $meta;
    /** @var array */
    protected $data = array();

    /**
     * @param EntityInterface $entity
     * @return EntityManager
     */
    final protected function add( EntityInterface $entity )
    {
        $this->data[] = $entity;
        return $this;
    }

    /**
     * Retourne un EntityManager en fonction de la valeur d'une propriété
     *
     * @example $myManager->find( "id" , 1234 );
     * @param string $key
     * @param mixed $value
     * @return EntityManager
     */
    public function find( $key , $value )
    {
        $EntityManager = new self();

        foreach( $this->data AS $entity )
            if ( $entity->get( $key ) == $value )
                $EntityManager->add( $entity );

        return $EntityManager;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return EntityManager
     */
    public function setMeta( $key , $value = null )
    {
        $this->meta[$key] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeta( $key )
    {
        return $this->meta[$key];
    }

    /**
     * @return Entity|null
     */
    public function getFirst()
    {
        return ( isset( $this->data[0] ) ) ? $this->data[0] : null;
    }

    /**
     * @return Entity|null
     */
    public function getLast()
    {
        return ( isset( $this->data[ $this->count() - 1 ] ) ) ? $this->data[ $this->count() - 1 ] : null;
    }

    /**
     * Return the current element
     * @return Entity
     */
    public function current()
    {
        return ( $this->valid() ) ? $this->data[ $this->index ] : null;
    }

    /**
     * @return EntityManager
     */
    public function next()
    {
        $this->index++;
        return $this;
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
        return isset( $this->data[ $this->index ] );
    }

    /**
     * Rewind the Iterator to the first element
     * @return EntityManager
     */
    public function rewind()
    {
        $this->index = 0;
        return $this;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count( $this->data );
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count();
    }

    /**
     * @param array $data
     * @return EntityManager
     */
    public function setArray( array $data )
    {
        foreach( $data AS $entity )
            $this->add( $entity );

        return $this->rewind();
    }

    /**
     * @param bool $displayAsNull
     * @return array
     */
    public function toArray( $displayAsNull = false )
    {
        $arr = parent::toArray( $displayAsNull );
        $arr['data'] = array();

        foreach ( $this AS $Entity )
            $arr['data'][] = $Entity->toArray( $displayAsNull );

        return $arr;
    }

    /**
     * @return EntityManager
     */
    public function removeAll()
    {
        $this->data = array();
        return $this;
    }

}