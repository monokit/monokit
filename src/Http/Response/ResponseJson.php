<?php

namespace MonoKit\Http\Response;

use MonoKit\Foundation\Interfaces\JsonInterface;

Class ResponseJson extends Response
{
    const CONTENT_TYPE = "application/json";

    /**
     * ResponseJson constructor.
     * @param mixed $content
     * @param int $status
     */
    public function __construct( $content = null , $status = self::HTTP_OK )
    {
        if ( $content instanceof JsonInterface )
            $content = $content->toJson();

        parent::__construct( $content , $status );
    }
}