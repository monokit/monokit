<?php

namespace MonoKit\Foundation;

use MonoKit\Registry\Registry;

Abstract Class Foundation
{
    /**
     * @param string|null $key
     * @param mixed|null $value
     * @return mixed|Registry
     * @throws \MonoKit\Registry\RegistryException
     */
    public function AppRegistry( $key = null , $value = null )
    {
        if ( !is_null($key) && is_null($value) )
            return Registry::getInstance()->get( $key );
        elseif ( !is_null($key) )
            return Registry::getInstance()->set( $key , $value );

        return Registry::getInstance();
    }

    /**
     * @return int
     */
    public function getUniqueId()
    {
        return hexdec( uniqid() );
    }

    /**
     * Retourne le nom de la Classe d'instance (sans namespace)
     *
     * @return string
     */
    final protected function getClassName()
    {
        return basename( get_class( $this ) );
    }

    /**
     * Retourne le namespace de l'instance
     *
     * @return string
     */
    final protected function getClassNamespace()
    {
        return substr( get_class($this) , 0 , strrpos( get_class($this) , '\\' ) );
    }

    /**
     * Retourne le type d'object
     *
     * @return string
     */
    final public function __toString()
    {
        return "[ " . get_class( $this ) . " ]";
    }

    /**
     * Gestion des erreurs dev
     *
     * @param $method
     * @param $arguments
     * @throws FoundationException
     */
    final public function __call( $method , $arguments )
    {
        throw new FoundationException( FoundationException::ERROR_METHOD , $this , $method );
    }
}

    define( "__DOT__"       , "." );
    define( "__BR__"        , "<BR>" );
    define( "__HR__"        , "<HR>" );
    define( "__DS__"        , "/" );
    define( "__SPACE__"     , " " );
    define( "__EMPTY__"     , "''" );
    define( "__RETURN__"    , "\n" );

    define( "__ROOT__" , ( !empty( $_SERVER["QUERY_STRING"] ) ) ? substr( $_SERVER["REQUEST_URI"] , 0, -(strlen( $_SERVER["QUERY_STRING"] ) ) ) : $_SERVER["REQUEST_URI"] );

    define( "MONOKIT_APPLICATION_DIRECTORY_VIEW"        , "View" );
    define( "MONOKIT_APPLICATION_DIRECTORY_CONTROLLER"  , "Controller" );
    define( "MONOKIT_APPLICATION_ROUTE_SEPARATOR"       , ":" );

?>