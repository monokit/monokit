<?php

namespace MonoKit\Http\Response;

use MonoKit\Foundation\Interfaces\JsonInterface;
use MonoKit\Http\Header;

Class ResponseJson extends Response
{
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

        $this->addHeader( new Header( "Content-Type" , "application/json" ) );
    }
}