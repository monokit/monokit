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
     * @return int
     */
    public function getUniqueId()
    {
        return number_format( hexdec( uniqid() ) , 0 , '', '' );
    }

    /**
     * @return string
     */
    public function getLoremIpsum()
    {
        return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquam neque eu enim tempus, non mattis augue scelerisque. Donec quis diam nec libero lacinia aliquet. Vestibulum sed rutrum nunc, sed convallis leo. Phasellus elementum, velit ac rutrum luctus, elit erat venenatis orci, suscipit sollicitudin massa purus sed justo. Pellentesque at orci et metus dapibus aliquet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse in posuere mauris. Donec suscipit eleifend consectetur. Pellentesque sollicitudin sodales lectus rutrum tristique. Ut rhoncus dolor sed neque mollis interdum. Sed tempor rhoncus odio vel ullamcorper.";
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
