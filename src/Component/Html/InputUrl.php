<?php

namespace MonoKit\Component\Html;

Class InputUrl extends Input
{
    /**
     * InputUrl constructor.
     * @param string $name
     * @param string $value
     * @param string $placeholder
     */
    public function __construct( $name = null , $value = null , $placeholder = null )
    {
        parent::__construct( Input::TYPE_URL , $name , $value );

        $this->placeholder( $placeholder );
    }

}