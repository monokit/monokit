<?php

namespace MonoKit\Http\Response;

use MonoKit\Foundation\Interfaces\JsonInterface;

Class ResponseJson extends Response
{
    const RESPONSE_HEADER = "Content-Type: application/json";

    /**
     * ResponseJson constructor.
     * @param JsonInterface|null $content
     * @param int $status
     */
    public function __construct( JsonInterface $content = null , $status = 200 )
    {
        parent::__construct( $content->toJson() , $status );
    }

}