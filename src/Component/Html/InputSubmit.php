<?php

namespace MonoKit\Component\Html;

Class InputSubmit extends Input
{
    /**
     * InputSubmit constructor.
     * @param string $value
     */
    public function __construct( $value )
    {
        parent::__construct( Input::TYPE_SUBMIT , null , $value );
    }
}