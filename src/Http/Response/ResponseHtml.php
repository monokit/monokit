<?php

namespace MonoKit\Http\Response;

class ResponseHtml extends Response
{
    public function __construct( $content )
    {
        header('Content-type: text/html');
        parent::__construct( $content );
    }
}