<?php

namespace MonoKit\Http;

use MonoKit\EntityManager\EntityManager;

Class HeaderManager extends EntityManager
{
    /**
     * @param Header $header
     * @return EntityManager
     */
    public function addHeader( Header $header )
    {
        return parent::add( $header );
    }

    public function getListFromUrl( $url )
    {
        foreach( get_headers( $url , 1) AS $name => $value )
            $this->addHeader( new Header( $name , $value ) );

        return $this;
    }

    public function getListFromGlobals()
    {
        foreach( apache_request_headers() AS $name => $value )
            $this->addHeader( new Header( $name , $value ) );

        return $this;
    }
}