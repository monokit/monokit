<?php

namespace MonoKit\Http\Response;

use MonoKit\Foundation\Foundation;

Class Response extends Foundation
{
    /** @var mixed */
    protected $content;

    public function __construct( $content )
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}