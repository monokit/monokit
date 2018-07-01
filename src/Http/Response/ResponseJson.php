<?php

namespace MonoKit\Http\Response;

use MonoKit\Foundation\Interfaces\JsonInterface;

Class ResponseJson extends Response
{
    const CONTENT_TYPE = "application/json";

    /**
     * ResponseJson constructor.
     * @param mixed $content
     * @param bool $displayAsNull
     * @param int $status
     */
    public function __construct( $content = null , $displayAsNull = false , $status = self::HTTP_OK )
    {
        $content = ( $content instanceof JsonInterface )
            ? $content->toJson( $displayAsNull )
            : json_encode( $content );

        parent::__construct( $content , $status );
    }
}