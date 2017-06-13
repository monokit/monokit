<?php

namespace MonoKit\Component\Html;

Class InputHidden extends Input
{
    public function __construct( $name  , $value = null )
    {
        parent::__construct( Input::TYPE_HIDDEN , $name , $value );
    }
}