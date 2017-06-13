<?php

namespace MonoKit\Component\Html;

Class InputText extends Input
{
    /**
     * InputText constructor.
     * @param string $name
     * @param string $value
     * @param string $placeholder
     */
    public function __construct( $name = null , $value = null , $placeholder = null )
    {
        parent::__construct( Input::TYPE_TEXT , $name , $value );

        $this->placeholder( $placeholder );
    }
}