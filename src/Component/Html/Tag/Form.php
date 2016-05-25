<?php

namespace MonoKit\Component\Html\Tag;

Class Form extends Div
{
    const Tag = "form";

    /**
     * @param $value
     * @return Form
     */
    public function acceptCharset( $value )
    {
        return $this->addAttribute( "accept-charset" , $value );
    }

    /**
     * @param $value
     * @return Form
     */
    public function action( $value )
    {
        return $this->addAttribute( "action" , $value );
    }

    /**
     * @param $value
     * @return Form
     */
    public function autoComplete( $value )
    {
        return $this->addAttribute( "autoComplete" , $value );
    }

    /**
     * @param $value
     * @return Form
     */
    public function enctype( $value )
    {
        return $this->addAttribute( "enctype" , $value );
    }

    /**
     * @param $value
     * @return Form
     */
    public function method( $value )
    {
        return $this->addAttribute( "method" , $value );
    }

    /**
     * @param $value
     * @return Form
     */
    public function target( $value )
    {
        return $this->addAttribute( "target" , $value );
    }
}