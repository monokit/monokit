<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Input;
use MonoKit\Component\Html\Tag\Label;

Class InputRadio extends InputText
{
    /**
     * FormInputRadio constructor.
     * @param string $value
     * @param boolean $checked
     */
    public function __construct( $name , $value , $checked = false , $label = null )
    {
        parent::__construct( $name , $value );

        $this->type( Input::TYPE_RADIO  );
        $this->checked( $checked );

        if ( $label )
            $this->setLabel( new Label( $label ) );
    }
}