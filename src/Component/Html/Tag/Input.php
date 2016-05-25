<?php

namespace MonoKit\Component\Html\Tag;

use MonoKit\Component\Html\SupportClass\HtmlFormElement;

Class Input extends HtmlFormElement
{
    const Tag = "input";
    const TagClosed = false;

    const TYPE_BUTTON           = "button";
    const TYPE_CHECKBOX         = "checkbox";
    const TYPE_COLOR            = "color";
    const TYPE_DATE             = "date";
    const TYPE_DATETIME         = "datetime";
    const TYPE_DATETIME_LOCAL   = "datetime-local";
    const TYPE_EMAIL            = "email";
    const TYPE_FILE             = "file";
    const TYPE_HIDDEN           = "hidden";
    const TYPE_IMAGE            = "image";
    const TYPE_MONTH            = "month";
    const TYPE_PASSWORD         = "password";
    const TYPE_RADIO            = "radio";
    const TYPE_RANGE            = "range";
    const TYPE_RESET            = "reset";
    const TYPE_SEARCH           = "search";
    const TYPE_SUBMIT           = "submit";
    const TYPE_TEL              = "tel";
    const TYPE_TEXT             = "text";
    const TYPE_TIME             = "time";
    const TYPE_URL              = "url";
    const TYPE_WEEK             = "week";

    /**
     * @param string $value
     * @return Input
     */
    public function accept( $value )
    {
        return $this->addAttribute( "accept" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function alt( $value )
    {
        return $this->addAttribute( "alt" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function autocomplete( $value )
    {
        return $this->addAttribute( "autocomplete" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function autofocus( $value )
    {
        return $this->addAttribute( "autofocus" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function checked( $value )
    {
        return $this->addAttribute( "checked" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function dirname( $value )
    {
        return $this->addAttribute( "dirname" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function formaction( $value )
    {
        return $this->addAttribute( "formaction" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function formenctype( $value )
    {
        return $this->addAttribute( "formenctype" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function formmethod( $value )
    {
        return $this->addAttribute( "formmethod" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function formnovalidate( $value )
    {
        return $this->addAttribute( "formnovalidate" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function formtarget( $value )
    {
        return $this->addAttribute( "formtarget" , $value );
    }

    /**
     * @param int $value
     * @return Input
     */
    public function width( $value )
    {
        return $this->addAttribute( "width" , $value );
    }

    /**
     * @param int $value
     * @return Input
     */
    public function height( $value )
    {
        return $this->addAttribute( "height" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function min( $value )
    {
        return $this->addAttribute( "min" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function max( $value )
    {
        return $this->addAttribute( "max" , $value );
    }

    /**
     * @param int $value
     * @return Input
     */
    public function maxlength( $value )
    {
        return $this->addAttribute( "maxlength" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function multiple( $value )
    {
        return $this->addAttribute( "multiple" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function pattern( $value )
    {
        return $this->addAttribute( "pattern" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function placeholder( $value )
    {
        if ( empty( $value ) )
            return $this;

        return $this->addAttribute( "placeholder" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function readonly( $value )
    {
        return $this->addAttribute( "readonly" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function required( $value )
    {
        return $this->addAttribute( "required" , $value );
    }

    /**
     * @param int $value
     * @return Input
     */
    public function size( $value )
    {
        return $this->addAttribute( "size" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function src( $value )
    {
        return $this->addAttribute( "src" , $value );
    }

    /**
     * @param int $value
     * @return Input
     */
    public function step( $value )
    {
        return $this->addAttribute( "step" , $value );
    }

    /**
     * @param string $value
     * @return Input
     */
    public function type( $value )
    {
        return $this->addAttribute( "type" , $value );
    }

    /**
     * @param mixed $value
     * @return Input
     */
    public function value( $value )
    {
        if ( empty( $value ) )
            return $this;

        return $this->addAttribute( "value" , $value );
    }

}