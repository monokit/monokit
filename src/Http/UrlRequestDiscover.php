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

        $this->setUrl( "/" . $url );
        $this->setMethod( $_SERVER["REQUEST_METHOD"] );

        foreach( $_GET as $key => $value )
            $this->setParam( $key , $value );
    }
}