<?php

namespace MonoKit\Component\Html\SupportClass;

use MonoKit\EntityManager\Entity;
use MonoKit\Component\Html\Interfaces\HtmlInterface;

Abstract Class HtmlElement extends Entity implements HtmlInterface
{
    const Tag = "";
    const TagClosed = true;

    /** @var HtmlElementManager */
    protected $HtmlElementManager;
    /** @var HtmlAttributeManager */
    protected $HtmlAttributeManager;

    /**
     * HtmlElement constructor.
     * @param string $string
     */
    public function __construct( $string = "" )
    {
        $this->string = $string;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function name( $value )
    {
        return $this->addAttribute( "name" , $value );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setClass( $value )
    {
        return $this->addAttribute( "class" , $value  );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function title( $value )
    {
        return $this->addAttribute( "title" , $value );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function style( $value )
    {
        return $this->addAttribute( "style" , $value );
    }

    /**
     * @param HtmlElement $htmlElement
     * @return $this
     */
    public function addHtmlElement( HtmlElement $htmlElement )
    {
        $this->getHtmlElementManager()->addHtmlElement( $htmlElement );
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addAttribute( $key , $value = null )
    {
        return $this->addHtmlAttribute( new HtmlAttribute( $key , $value ) );
    }

    /**
     * @param HtmlAttribute $htmlAttribute
     * @return $this
     */
    protected function addHtmlAttribute( HtmlAttribute $htmlAttribute )
    {
        $this->getHtmlAttributeManager()->addHtmlAttribute( $htmlAttribute );
        return $this;
    }

    /**
     * @return HtmlElementManager
     */
    protected function getHtmlElementManager()
    {
        if ( !$this->hasHtmlElementManager() )
            $this->HtmlElementManager = new HtmlElementManager();

        return $this->HtmlElementManager;
    }

    /**
     * @return bool
     */
    protected function hasHtmlElementManager()
    {
        return ( $this->HtmlElementManager ) ? true : false;
    }

    /**
     * @return HtmlAttributeManager
     */
    protected function getHtmlAttributeManager()
    {
        if ( !$this->hasHtmlAttributeManager() )
            $this->HtmlAttributeManager = new HtmlAttributeManager();

        return $this->HtmlAttributeManager;
    }

    /**
     * @return bool
     */
    protected function hasHtmlAttributeManager()
    {
        return ( $this->HtmlAttributeManager ) ? true : false;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $str = $this->getTagStart();
        $str .= $this->string;

        if ( $this->hasHtmlElementManager() )
            foreach ( $this->HtmlElementManager AS $HtmlElement )
                $str .= $HtmlElement->toHtml();

        return $str . $this->getTagEnd();
    }

    /**
     * @return string
     */
    private function getTagStart()
    {
        $str = "<".static::Tag;

        if ( $this->hasHtmlAttributeManager() )
            foreach ( $this->HtmlAttributeManager AS $HtmlAttribute )
                $str .= $HtmlAttribute->toString();

        if ( static::TagClosed )
            return $str.">";

        return $str."/>";
    }

    /**
     * @return string
     */
    private function getTagEnd()
    {
        return ( static::TagClosed ) ? "</".static::Tag.">" : '';
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->toHtml();
    }

}