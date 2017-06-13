<?php

namespace MonoKit\Component\Html;

Class InputEmail extends Input
{
    /**
     * InputEmail constructor.
     * @param string $name
     * @param string $value
     * @param string $placeholder
     */
    public function __construct( $name = null , $value = null , $placeholder = null )
    {
        parent::__construct( Input::TYPE_EMAIL , $name , $value );

        $this->placeholder( $placeholder );
    }
}