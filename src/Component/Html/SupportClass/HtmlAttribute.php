<?php

namespace MonoKit\Component\Html\SupportClass;

use MonoKit\EntityManager\Entity;

Class HtmlAttribute extends Entity
{
    /** @var string */
    protected $key;
    /** @var string */
    protected $value;

    public function __construct( $key , $value = null )
    {
        $this->setKey($key);
        $this->setValue($value);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return HtmlAttribute
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return HtmlAttribute
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        if ( $this->getValue() )
            return sprintf( __SPACE__.'%s="%s"' , $this->getKey() , $this->getValue() );

        return __SPACE__.$this->getKey();
    }

}