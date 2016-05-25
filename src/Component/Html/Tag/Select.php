<?php

namespace MonoKit\Component\Html\Tag;

use MonoKit\Component\Html\SupportClass\HtmlFormElement;

Class Select extends HtmlFormElement
{
    const Tag = "select";

    /**
     * @param OptGroup $option
     * @return $this
     */
    public function add(OptGroup $option)
    {
        return parent::add($option);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function length( $value )
    {
        return $this->addAttribute( "length" , $value  );
    }

    /**
     * @return $this
     */
    public function multiple()
    {
        return $this->addAttribute( "multiple"  );
    }

    /**
     * @return $this
     */
    public function required()
    {
        return $this->addAttribute( "required" );
    }

    /**
     * @param int $value
     * @return $this
     */
    public function size( $value )
    {
        return $this->addAttribute( "size" , $value  );
    }
}