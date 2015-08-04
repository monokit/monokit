<?php

namespace MonoKit\Http\Response;

class ResponseJson extends Response
{
    public function __construct( $content )
    {
        header('Content-type: application/json');
        parent::__construct( $content );
    }

    public function getContent()
    {
        return json_encode( $this->content );
    }
}