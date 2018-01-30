<?php

namespace MonoKit\Http;

Class Method
{
    const GET    = "GET";
    const PUT    = "PUT";
    const ANY    = "ANY";
    const POST   = "POST";
    const HEAD   = "HEAD";
    const DELETE = "DELETE";

    /** @var string */
    protected $method;

    /**
     * Method constructor.
     * @param string $method
     */
    public function __construct( $method = self::GET )
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
            case self::PUT:
            case self::ANY:
            case self::POST:
            case self::HEAD:
            case self::DELETE:
                $this->method = $method;
                return $this;
        }

        $this->method = self::GET;
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
        return ( $this->method == $method || $this->method == self::ANY ) ? true : false;
    }
}