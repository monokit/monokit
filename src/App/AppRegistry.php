<?php

namespace MonoKit\App;

use MonoKit\Routing\RouteManager;
use MonoKit\Component\Registry\Registry;
use MonoKit\Component\Notify\NotifyManager;

Abstract Class AppRegistry
{
    const APPLICATION                   = "APPLICATION";
    const APPLICATION_ROUTES            = "APPLICATION.ROUTES";
    const APPLICATION_NOTIFY            = "APPLICATION.NOTIFY";
    const APPLICATION_SERVICE           = "APPLICATION.SERVICE";
    const APPLICATION_TRANSLATE         = "APPLICATION.TRANSLATE";

    /** @var Registry */
    private static $AppRegistry;

    /**
     * @param string $key
     * @param mixed|null $value
     * @param mixed|null $defaultValue
     * @return mixed
     * @throws \MonoKit\Component\Registry\Exception\RegistryException
     */
    public static function AppRegistry( $key , $value = null , $defaultValue = null )
    {
        if( is_null( self::$AppRegistry ) )
        {
            self::$AppRegistry = new Registry();
            self::$AppRegistry->set( self::APPLICATION_ROUTES   , new RouteManager() );
            self::$AppRegistry->set( self::APPLICATION_NOTIFY   , new NotifyManager() );
        }

        if ( is_null( $value ) && is_null( $defaultValue ) )
            return self::$AppRegistry->get( $key );
        elseif ( !is_null($key) )
            return self::$AppRegistry->set( $key , $value , $defaultValue );

        return self::$AppRegistry;
    }
}