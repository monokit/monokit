<?php

namespace MonoKit\Component\Html\SupportClass;

Abstract Class HtmlFormElement extends HtmlElement
{
    const Tag = "";

    /**
     * @return $this
     */
    public function disabled()
    {
        return $this->addAttribute( "disabled" );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function form( $value )
    {
        return $this->addAttribute( "form" , $value );
    }
}