<?php

namespace MonoKit\Component\Html\Tag;

Class Option extends OptGroup
{
    const Tag = "option";

    /**
     * @param string $value
     * @return $this
     */
    public function value( $value )
    {
        return $this->addAttribute( "value" , $value );
    }

    /**
     * @return $this
     */
    public function selected()
    {
        return $this->addAttribute( "selected" );
    }
}