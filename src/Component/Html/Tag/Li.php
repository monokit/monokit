<?php

namespace MonoKit\Component\Html\Tag;

Class Li extends Ul
{
    const Tag = "li";

    /**
     * @param mixed $value
     * @return $this
     */
    public function value( $value )
    {
        return $this->addAttribute( "value" , $value );
    }
}