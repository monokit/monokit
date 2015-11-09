<?php

namespace MonoKit\Http\Response;

use MonoKit\Foundation\Foundation;

Class Response extends Foundation
{
    /** @var mixed */
    protected $content;

    /**
     * Response constructor.
     * @param $content
     */
    public function __construct( $content )
    {
        $this->setContent( $content );
    }

    /**
     * @param $content
     * @return Response
     */
    public function setContent( $content )
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}