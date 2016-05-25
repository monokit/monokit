<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Input;

Class FormInputUrl extends FormInput
{
    public function __construct( $value = null , $placeholder = null )
    {
        parent::__construct( Input::TYPE_URL , $value , $placeholder );
    }
}