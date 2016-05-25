<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Input;

Class FormInputRadio extends FormInput
{
    /**
     * FormInputRadio constructor.
     * @param string $value
     * @param string $placeholder
     */
    public function __construct( $value , $placeholder = null )
    {
        parent::__construct( Input::TYPE_RADIO , $value , $placeholder );

        $this->setUniqueId();
    }
}