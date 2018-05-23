<?php

namespace MonoKit\Model;

use MonoKit\EntityManager\Entity;

Class Url extends Entity
{
    const PORT_DEFAULT = 80;

    /** @var string */
    protected $url;

    /**
     * Url constructor.
     * @param string|null $url
     */
    public function __construct( $url = null )
    {
        $this->setUrl( $url );
    }

    /**
     * @param string $url
     * @return Url
     */
    public function setUrl( $url )
    {
        $this->url = ( filter_var( $url , FILTER_VALIDATE_URL ) ) ? $url : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return ( $this->url ) ? true : false;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return parse_url( $this->url , PHP_URL_HOST );
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return parse_url( $this->url , PHP_URL_PATH );
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return ( $port = parse_url( $this->url , PHP_URL_PORT ) ) ? $port : self::PORT_DEFAULT;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return parse_url( $this->url , PHP_URL_QUERY );
    }

    /**
     * @return mixed
     */
    public function getScheme()
    {
        return parse_url( $this->url , PHP_URL_SCHEME );
    }

}