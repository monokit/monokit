<?php

namespace MonoKit\EntityManager;

use MonoKit\Foundation\Foundation;
use MonoKit\Foundation\Interfaces\ArrayInterface;
use MonoKit\Foundation\Interfaces\JsonInterface;
use MonoKit\EntityManager\Interfaces\EntityInterface;

Abstract Class Entity extends Foundation implements EntityInterface, ArrayInterface, JsonInterface
{
    /**
     * @param string $property
     * @param mixed $value
     * @return Entity
     */
    public function set( $property , $value = null )
    {
        if ( is_null($value) )
            return null;

        @list( $instanceName , $instanceProperty ) = explode( '.' , $property , 2 );

        if ( !$methodSet = $this->getMethodSet( $instanceName ) )
            return false;

        if ( !$this->get( $instanceName ) )
        {
            $class = new \ReflectionClass( $this );
            $params = $class->getMethod( $methodSet )->getParameters();

            if ( $instance = @$params[0]->getClass()->name )
                $this->$methodSet( new $instance() );
        }

        if ( strpos( $property , "." ) )
            return $this->get( $instanceName )->set( $instanceProperty , $value );

        if ( is_array( $value ) && $this->get( $instanceName ) instanceof Entity )
            return $this->get( $instanceName )->serialize( $value );

        return $this->$methodSet( $value );
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function get( $property = null )
    {
        if ( is_null($property) )
            return null;

        // Conditions
        if ( strpos( $property , ":" ) )
        {
            $properties = explode( ":" , $property , 2 );

            if ( $return = $this->get( current($properties) ) )
                return $return;

            return $this->get( end($properties) );
        }

        // SubEntity
        if ( strpos( $property , "." ) )
        {
            list( $instanceName , $instanceProperty ) = explode( '.' , $property , 2 );
            return ( $this->get( $instanceName ) ) ? $this->get( $instanceName )->get( $instanceProperty ) : false;
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
        if ( $method = $this->getMethodSet( "id" ) )
            $this->$method( $this->getUniqueId() );

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
     * @return Entity
     */
    public function getClone()
    {
        return new $this();
    }

    /**
     * @param array|null $properties
     * @return Entity
     */
    public function serialize( array $properties = array() )
    {
        foreach ( $properties AS $property => $value )
            $this->set( $property , $value );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $arr = array();

        foreach ( get_object_vars($this) AS $key => $value )
            if ( !is_null($value) )
                $arr[$key] = ( $value instanceof Entity ) ? $value->toArray() : $value;

        return $arr;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode( $this->toArray() );
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
}