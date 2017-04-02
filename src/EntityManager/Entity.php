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
            return $this;

        if ( is_array( $value ) && $this->get( $property ) instanceof Entity )
            return $this->get( $property )->serialize( $value );

        // SubEntity
        if ( strpos( $property , "." ) )
        {
            list( $instanceName , $instanceProperty ) = explode( '.' , $property , 2 );

            if ( $this->get( $instanceName ) instanceof Entity )
                return $this->get( $instanceName )->set( $instanceProperty , $value );

            $class = new \ReflectionClass( $this );
            $params = $class->getMethod( $this->getMethodSet( $instanceName ) )->getParameters();

            if ( $instance = $params[0]->getClass()->name )
            {
                $method = $this->getMethodSet( $instanceName );
                $this->$method( new $instance() );

                return $this->get( $instanceName )->set( $instanceProperty , $value );
            }

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
        foreach ( $properties as $property => $value )
            $this->set( $property , $value );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray( array $arr = array() )
    {
        foreach ( get_object_vars($this) AS $key => $value )
            if ( !is_null( $value ) ) //$value = $this->get( $key )
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