<?php

namespace MonoKit\Component\Html\Tag;

use MonoKit\Component\Html\SupportClass\HtmlFormElement;

Class OptGroup extends HtmlFormElement
{
    const Tag = "optgroup";

    /**
     * @param Option $option
     * @return $this
     */
    public function add( Option $option )
    {
        return parent::add( $option );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function label( $value )
    {
        return $this->addAttribute( "label" , $value );
    }
}