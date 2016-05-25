<?php

namespace MonoKit\Component\Html\Tag;

use MonoKit\Component\Html\SupportClass\HtmlElement;

Class Script extends HtmlElement
{
    const Tag = "script";
    
    public function __construct( $string = null )
    {
        parent::__construct( $string );
        
        $this->addAttribute( "type" , "text/javascript" );
    }
}