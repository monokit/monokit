<?php

namespace MonoKit\Http;

class UrlRequestDiscover extends UrlRequest
{
    /**
     * UrlRequestDiscover constructor.
     */
    public function __construct()
    {
        $this->setUrl( "/" . $_SERVER["QUERY_STRING"] );
        $this->setMethod( $_SERVER["REQUEST_METHOD"] );
    }
}