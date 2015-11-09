<?php

namespace MonoKit\Http\Response;

class ResponseJson extends Response
{
    /**
     * ResponseJson constructor.
     * @param string $content
     */
    public function __construct( $content )
    {
        header('Content-type: application/json');
        parent::__construct( $content );
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return json_encode( $this->content );
    }
}