<?php

namespace MonoKit\Http;

Class UrlRequestDiscover extends UrlRequest
{
    /**
     * UrlRequestDiscover constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $url = ( isset( $_SERVER["REDIRECT_QUERY_STRING"] ) ) ? $_SERVER["REDIRECT_QUERY_STRING"] : "";
        $url = ( strstr( $url , "&" , true ) ) ? strstr( $url , "&" , true ) : $url;

        $this->setUrl( "/" . $url );
        $this->setMethod( new Method( ( isset( $_POST["_method"] ) ) ? $_POST["_method"] : $_SERVER[ "REQUEST_METHOD" ] ) );

        if ( isset( $_SERVER["CONTENT_TYPE"] ) )
            $this->setContentType( $_SERVER["CONTENT_TYPE"] );

        if ( $_posts = json_decode( file_get_contents("php://input") , true ) )
            foreach ( $_posts AS $key => $value )
                $this->setParameter( $key , $value );

        foreach( $_REQUEST as $key => $value )
            $this->setParameter( $key , $value );

    }
}