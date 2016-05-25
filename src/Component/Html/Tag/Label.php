<?php

namespace MonoKit\Component\Html\Tag;

use MonoKit\Component\Html\SupportClass\HtmlTextElement;

Class Label extends HtmlTextElement
{
    const Tag = "label";

    public function setFor( $value )
    {
        return $this->addAttribute( "for" , $value );
    }
}