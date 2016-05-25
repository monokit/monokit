<?php

namespace MonoKit\Component\Html\Tag;

use MonoKit\Component\Html\SupportClass\HtmlElement;

Class A extends HtmlElement
{
    const Tag = "a";

    /**
     * @param string $value
     * @return A
     */
    public function href( $value )
    {
        return $this->addAttribute( "href" , $value );
    }

    /**
     * @param string $value
     * @return A
     */
    public function target( $value )
    {
        return $this->addAttribute( "target" , $value );
    }
}