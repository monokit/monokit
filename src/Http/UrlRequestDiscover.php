<?php

namespace MonoKit\Http;

class UrlRequestDiscover extends UrlRequest
{
    /**
     * UrlRequestDiscover constructor.
     */
    public function __construct()
    {
        $url = ( isset( $_SERVER["REDIRECT_QUERY_STRING"] ) ) ? $_SERVER["REDIRECT_QUERY_STRING"] : "";
        $url = ( strstr( $url , "&" , true ) ) ? strstr( $url , "&" , true ) : $url;

        $method = ( isset( $_POST["_method"] ) ) ? $_POST["_method"] : $_SERVER[ "REQUEST_METHOD" ];

        $this->setUrl( "/" . $url );
        $this->setMethod( $method );

        foreach( $_GET as $key => $value )
            $this->setParam( $key , $value );
    }
}