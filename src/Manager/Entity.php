<?php

namespace MonoKit\Manager;

use MonoKit\Foundation\Foundation;

Abstract Class Entity extends Foundation implements EntityInterface
{
    /**
     * @param array $properties
     * @return Entity
     */
    public function setProperties( array $properties )
    {
        foreach ( $properties as $property => $value )
            $this->setProperty( $property , $value );

        return $this;
    }

    /**
     * @param string $property
     * @param mixed $value
     * @return Entity
     */
    final public function setProperty( $property , $value )
    {
        if ( empty( $value ) || is_null( $value ) )
            return $this;

        if ( strpos( $property , "." ) )
        {
            list( $instanceName , $instanceProperty ) = explode( '.' , $property , 2 );

            if ( !method_exists( $this , $method = "set".ucfirst( $instanceName ) ) || !$instance = $this->getProperty( $instanceName ) )
            {
                // Vérification d'une méthode [createXXXX]
                if ( !method_exists( $this , $method = "create".ucfirst( $instanceName ) ) )
                    return $this;

                $instance = $this->$method();
            }

            $instance->setProperty( $instanceProperty , $value );

            return $this->setProperty( $instanceName , $instance );
        }

        if ( !method_exists( $this , $method = "set".ucfirst( $property ) ) )
            return $this;

        $this->$method( $value );

        return $this;
    }

    /**
     * @param string $property
     * @return mixed|null
     */
    final public function getProperty( $property )
    {
        $method = "get".ucfirst( $property );

        if ( strpos( $property , "." ) )
        {
            list( $instance , $property ) = explode( '.' , $property , 2 );

            $method = "get".ucfirst( $instance );

            if ( $this->$method() instanceof Entity )
                return $this->$method()->getProperty( $property );

        }

        return $this->$method();
    }

    /**
     * @param string $property
     * @param mixed $value
     * @return Entity
     */
    final public function __set( $property , $value )
    {
        return $this->setProperty( $property , $value );
    }

    /**
     * @param string $property
     * @return mixed|null
     */
    final public function __get( $property )
    {
        return $this->getProperty( $property );
    }

}

?>
