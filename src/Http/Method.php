<?php

namespace MonoKit\Http;

Class Method
{
    const __GET__       = "GET";
    const __PUT__       = "PUT";
    const __ANY__       = "ANY";
    const __POST__      = "POST";
    const __HEAD__      = "HEAD";
    const __DELETE__    = "DELETE";

    /** @var string */
    protected $method = self::__GET__;

    /**
     * MethodRequest constructor.
     * @param string $method
     */
    public function __construct( $method = self::__GET__ )
    {
        $this->setMethod( $method );
    }

    /**
     * @param string $method
     * @return Method
     */
    public function setMethod( $method )
    {
        switch ( $method = strtoupper( $method ) )
        {
            case self::__PUT__:
            case self::__ANY__:
            case self::__POST__:
            case self::__HEAD__:
            case self::__DELETE__:
                $this->method = $method;
                return $this;
        }

        $this->method = self::__GET__;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return bool
     */
    public function is( $method )
    {
        return ( $this->method == $method || $this->method == self::__ANY__ ) ? true : false;
    }
}