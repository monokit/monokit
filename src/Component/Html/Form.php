<?php

namespace MonoKit\Component\Html;

Class Form extends \MonoKit\Component\Html\Tag\Form
{
    public function __construct()
    {
        parent::__construct();

        $this->method( "post" );
    }
}