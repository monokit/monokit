<?php

namespace MonoKit\Http\Response;

use MonoKit\Foundation\Interfaces\JsonInterface;

Class ResponseJson extends Response
{
    const RESPONSE_HEADER = "Content-Type: application/json";

    /**
     * ResponseJson constructor.
     * @param mixed $content
     * @param int $status
     */
    public function __construct( $content = null , $status = 200 )
    {
        if ( $content instanceof JsonInterface )
            $content = $content->toJson();

        parent::__construct( $content , $status );
    }
}