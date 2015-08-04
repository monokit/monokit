<?php

namespace MonoKit\Http\Response;

class ResponseXml extends Response
{
    public function __construct( $content )
    {
        header('Content-type: application/xml');
        parent::__construct( $content );
    }

}