<?php

namespace MonoKit\Component\Html\SupportClass;

use MonoKit\EntityManager\EntityManager;

Class HtmlElementManager extends EntityManager
{
    public function add( HtmlElement $htmlElement )
    {
        return parent::add( $htmlElement );
    }
}