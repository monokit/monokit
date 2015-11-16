<?php

namespace MonoKit\Foundation;

use MonoKit\Http\Route;
use MonoKit\Http\RouteManager;
use MonoKit\Http\UrlRequestDiscover;
use MonoKit\Registry\Registry;

Abstract Class Foundation
{
    /** @var Registry */
    private static $AppRegistry_instance;
    /** @var RouteManager */
    private static $AppRouter_instance;
    /** @var Registry */
    private static $AppService_instance;

    /**
     * @param string|null $key
     * @param mixed|null $value
     * @return mixed|Registry
     * @throws \MonoKit\Registry\RegistryException
     */
    public static function AppRegistry( $key = null , $value = null , $defaultValue = null )
    {
        if( is_null( self::$AppRegistry_instance ) )
            self::$AppRegistry_instance = new Registry();

        if ( !is_null($key) && is_null($value) && is_null($defaultValue) )
            return self::$AppRegistry_instance->get( $key );
        elseif ( !is_null($key) )
            return self::$AppRegistry_instance->set( $key , $value , $defaultValue );

        return self::$AppRegistry_instance;
    }

    /**
     * @param string|null $routeName
     * @param Route|null $route
     * @return RouteManager
     */
    public static function AppRouter( $routeName = null , Route $route = null )
    {
        if( is_null( self::$AppRouter_instance ) )
            self::$AppRouter_instance = new RouteManager();

        if ( !is_null($routeName) && is_null($route) )
            return self::$AppRouter_instance->getRouteByName( $routeName );
        elseif ( !is_null($routeName) )
            return self::$AppRouter_instance->addRoute( $route );

        return self::$AppRouter_instance;
    }

    /**
     * @param string|null $key
     * @param mixed|null $value
     * @return mixed|Registry
     * @throws \MonoKit\Registry\RegistryException
     */
    public static function AppService( $key = null , $value = null )
    {
        if( is_null( self::$AppService_instance ) )
            self::$AppService_instance = new Registry();

        if ( !is_null($key) && is_null($value) )
            return self::$AppService_instance->get( $key );
        elseif ( !is_null($key) )
            return self::$AppService_instance->set( $key , $value );

        return self::$AppService_instance;
    }

    /**
     * @param string $label
     * @param string $message
     * @return $this
     */
    public function addFlash( $label , $message )
    {
        $this->AppRegistry( "SYSTEM.FLASH.{$label}" , $message );
        return $this;
    }

    /**
     * @param $label
     * @return mixed|Registry
     */
    public function getFlash( $label )
    {
        return $this->AppRegistry()->get( "SYSTEM.FLASH.{$label}" );
    }

    /**
     * @param $label
     * @return bool
     */
    public function hasFlash( $label )
    {
        return $this->AppRegistry()->has( "SYSTEM.FLASH.{$label}");
    }

    /**
     * Retourne le nom de la Classe d'instance (sans namespace)
     *
     * @return string
     */
    final protected function getClassName()
    {
        return end( explode( "\\" , get_class($this) ) );
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
     * @return UrlRequestDiscover
     */
    public function getUrlRequest()
    {
        return new UrlRequestDiscover();
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

    define( "__SRC__" , __DIR__ . "/../../../../../src/" );
    define( "__ROOT__" , ( !empty( $_SERVER["QUERY_STRING"] ) ) ? substr( $_SERVER["REQUEST_URI"] , 0, -(strlen( $_SERVER["QUERY_STRING"] ) ) ) : $_SERVER["REQUEST_URI"] );

    define( "MONOKIT_APPLICATION_VIEW_DIRECTORY"        , "View" );
    define( "MONOKIT_APPLICATION_ROUTE_SEPARATOR"       , ":" );
    define( "MONOKIT_APPLICATION_CONTROLLER_SUFFIX"     , "Controller" );

?>