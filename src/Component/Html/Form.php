<?php

namespace MonoKit\Component\Html;

Class Form extends \MonoKit\Component\Html\Tag\Form
{
    public function __construct( $name = null , $method = "POST" , $action = null )
    {
        parent::__construct();

        $this->name( $name );
        $this->method( $method );
        $this->action( $action );
    }
}