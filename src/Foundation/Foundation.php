<?php

namespace MonoKit\Foundation;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Notify\NotifyInterface;
use MonoKit\Foundation\Interfaces\StringInterface;

Abstract Class Foundation implements StringInterface
{
    /**
     * @param NotifyInterface $notify
     * @return Foundation
     */
    protected function addNotify( NotifyInterface $notify )
    {
        AppRegistry::AppRegistry( AppRegistry::APPLICATION_NOTIFY )->add( $notify );
        return $this;
    }

    /**
     * @return string
     */
    final public function getClassName()
    {
        return get_class( $this );
    }

    /**
     * @return string
     */
    final public function getClassBaseName()
    {
        return end( explode( "\\" , $this->getClassName() ) );
    }

    /**
     * @return string
     */
    final public function getClassNamespace()
    {
        return substr( $this->getClassName() , 0 , strrpos( $this->getClassName() , '\\' ) );
    }

    /**
     * @return string
     */
    final public function __toString()
    {
        return ( is_null( $this->toString() ) ) ? '' : $this->toString();
    }

    /**
     * @return string
     */
    public function toString()
    {
        return "[ " . get_class( $this ) . " ]";
    }

    /**
     * @param string $value
     * @return string
     */
    static public function preventDoubleQuote( $value )
    {
        return str_replace( "'" , "''" , $value );
    }

    /**
     * @param string|bool $value
     * @return bool
     */
    static function boolean( $value )
    {
        return ($value === true || $value === "true") ? true : false;
    }
}

define( "__BR__"        , "<BR>" );
define( "__HR__"        , "<HR>" );
define( "__DS__"        , "/" );            // DIRECTORY SEPARATOR
define( "__NSS__"       , '\\' );           // NAMESPACE SEPARATOR
define( "__DOT__"       , "." );
define( "__SPACE__"     , " " );
define( "__EMPTY__"     , "''" );
define( "__LOREM__"     , "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mollis aliquet euismod. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin interdum ultricies odio id luctus. Pellentesque eu massa vitae mi semper blandit. Ut lobortis ex ultrices sem auctor, vel finibus nisl viverra. Morbi pulvinar sapien lacus. Vivamus mollis fermentum purus, vel laoreet neque tempus id. Sed tempus tristique vestibulum. Maecenas nec felis facilisis, molestie ipsum et, placerat tellus. Ut hendrerit tempus vestibulum. Suspendisse potenti." );

define( "__ROUTE_SEPARATOR__" , ":" );

define( "__SRC__"       , __DIR__ . "/../../../../../src/" );
define( "__ROOT__"      , ( !empty( $_SERVER["QUERY_STRING"] ) ) ? substr( $_SERVER["REQUEST_URI"] , 0, -(strlen( $_SERVER["QUERY_STRING"] ) ) ) : $_SERVER["REQUEST_URI"] );