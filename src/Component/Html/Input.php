<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Label;

Class Input extends \MonoKit\Component\Html\Tag\Input
{
    /** @var Label */
    protected $Label;

    /**
     * Input constructor.
     * @param string $type
     * @param string $name
     * @param string $value
     */
    public function __construct( $type = Input::TYPE_TEXT , $name = null , $value = null )
    {
        parent::__construct();

        $this->type( $type );
        $this->name( $name );
        $this->value( $value );
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
        return $this->Label->setFor( $this->get('name') );
    }
}