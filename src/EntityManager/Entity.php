<?php

namespace MonoKit\EntityManager;

use MonoKit\Foundation\Foundation;
use MonoKit\EntityManager\Interfaces\EntityInterface;

Abstract Class Entity extends Foundation implements EntityInterface
{
    /** @var mixed */
    protected $id;

    /**
     * @param $id
     * @return Entity
     */
    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $property
     * @param mixed $value
     * @return Entity
     */
    public function set( $property , $value )
    {
        // SubEntity
        if ( strpos( $property , "." ) )
        {
            list( $instanceName , $instanceProperty ) = explode( '.' , $property , 2 );
            return ( $this->get( $instanceName ) instanceof Entity ) ? $this->get( $instanceName )->set( $instanceProperty , $value ) : $this;
        }

        if ( $method = $this->getMethodSet( $property ) )
            $this->$method( $value );

        return $this;
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function get( $property = null )
    {
        if ( is_null($property) )
            return null;

        // SubEntity
        if ( strpos( $property , "." ) )
        {
            list( $instanceName , $instanceProperty ) = explode( '.' , $property , 2 );
            return $this->get( $instanceName )->get( $instanceProperty );
        }

        if ( $method = $this->getMethodGet( $property ) )
            return $this->$method();

        return null;
    }

    /**
     * @return Entity
     */
    public function setUniqueId()
    {
        return $this->setId( $this->getUniqueId() );
    }

    /**
     * @param array $properties
     * @return Entity
     */
    public function serialize( array $properties )
    {
        foreach ( $properties as $property => $value )
            $this->set( $property , $value );

        return $this;
    }

    /**
     * Génère un identifiant unique
     *
     * @return int
     */
    public function getUniqueId()
    {
        return number_format( hexdec( uniqid() ) , 0 , '', '' );
    }

    /**
     * @param string $property
     * @return string
     */
    private function getMethodSet( $property )
    {
        if ( !method_exists( $this , $method = "set" . ucfirst( $property ) ) )
            return null;

        return $method;
    }

    /**
     * @param string $property
     * @return string
     */
    private function getMethodGet( $property )
    {
        if ( !method_exists( $this , $method = "get" . ucfirst( $property ) ) )
            return null;

        return $method;
    }

    /**
     * @return Entity
     */
    public function getClone()
    {
        return new $this();
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset( $name = null )
    {
        if ( is_null( $name ) )
            return false;

        $var = $this->get( $name );

        return isset( $var );
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get( $name )
    {

        return $this->get( $name );
    }

}