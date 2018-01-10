<?php

namespace MonoKit\EntityManager;

use MonoKit\EntityManager\Interfaces\EntityInterface;
use MonoKit\EntityManager\Interfaces\EntityManagerInterface;
use MonoKit\Foundation\Interfaces\ArrayInterface;
use MonoKit\Foundation\Interfaces\CountInterface;
use MonoKit\Foundation\Interfaces\JsonInterface;

Class EntityManager extends Entity implements EntityManagerInterface, ArrayInterface , CountInterface, JsonInterface
{
    /** @var int */
    private $index = 0;
    /** @var EntityManagerMeta */
    protected $meta;
    /** @var array */
    protected $data = array();

    /**
     * EntityManager constructor.
     */
    public function __construct()
    {
        $this->meta = new EntityManagerMeta();
    }

    /**
     * @param EntityInterface $entity
     * @return EntityManager
     */
    public function add( EntityInterface $entity )
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
     * @param EntityManagerMeta $meta
     * @return EntityManager
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return EntityManagerMeta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @return Entity|null
     */
    public function getFirst()
    {
        if ( isset( $this->data[0] ) )
            return $this->data[0];

        return null;
    }

    /**
     * @return Entity|null
     */
    public function getLast()
    {
        return $this->data[ $this->count() - 1 ];
    }

    /**
     * Return the current element
     * @return Entity
     */
    public function current()
    {
        return $this->data[ $this->index ];
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
     * @return EntityManager
     */
    public function removeAll()
    {
        $this->data = array();
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $arr = parent::toArray();
        $arr['data'] = array();

        foreach ( $this AS $Entity )
            $arr['data'][] = $Entity->toArray();

        return $arr;
    }
}

class EntityManagerMeta extends Entity
{
    /** @var string */
    protected $title;
    /** @var string */
    protected $description;
    /** @var boolean */
    protected $status;
    /** @var string */
    protected $message;
    /** @var bool */
    protected $enabled;
    /** @var bool */
    protected $editable;

    /**
     * @param string $title
     * @return EntityManager
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $description
     * @return EntityManager
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param boolean $status
     * @return EntityManagerMysqli
     */
    public function setStatus( $status )
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param string $message
     * @return EntityManagerMysqli
     */
    public function setMessage( $message )
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param boolean $enabled
     * @return EntityManagerMeta
     */
    public function setEnabled($enabled)
    {
        $this->enabled = ( $enabled == true || $enabled == 'true' ) ? true : false;;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $editable
     * @return EntityManagerMeta
     */
    public function setEditable($editable)
    {
        $this->editable = ( $editable == true || $editable == 'true' ) ? true : false;;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isEditable()
    {
        return $this->editable;
    }
}