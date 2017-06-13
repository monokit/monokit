<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Input;

Class InputSearch extends InputText
{
    /**
     * InputSearch constructor.
     * @param string $name
     * @param string $value
     * @param string $placeholder
     */
    public function __construct( $name = null , $value = null , $placeholder = null )
    {
        parent::__construct( $name , $value , $placeholder );

        $this->type( Input::TYPE_SEARCH );
    }
}