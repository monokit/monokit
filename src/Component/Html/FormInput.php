<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Input;
use MonoKit\Component\Html\Tag\Label;

Class FormInput extends Input
{
    /** @var Label */
    protected $Label;

    public function __construct( $type , $value = null , $placeholder = null )
    {
        parent::__construct();

        $this->type( $type );
        $this->value( $value );
        $this->placeholder( $placeholder );
    }

    /**
     * @param Label $label
     * @return $this
     */
    public function setLabel( Label $label )
    {
        $this->Label = $label;
        return $this;
    }

    /**
     * @return Label
     */
    public function getLabel()
    {
        return $this->Label->setFor( $this->getId() );
    }

}