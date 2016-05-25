<?php

namespace MonoKit\Component\Html\Tag;

use MonoKit\Component\Html\SupportClass\HtmlTextElement;

Class P extends HtmlTextElement
{
    const Tag = "p";

    const ALIGN_LEFT = "left";
    const ALIGN_RIGHT = "right";
    const ALIGN_CENTER = "center";
    const ALIGN_JUSTIFY = "justify";

    /**
     * @param string $value
     * @return $this
     */
    public function align( $value )
    {
        return $this->addAttribute( "align" , $value );
    }
}