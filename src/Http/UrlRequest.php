<?php

namespace MonoKit\Http;

use MonoKit\EntityManager\Entity;
use MonoKit\Component\Registry\Registry;

Class UrlRequest extends Entity
{
    /** @var string */
    protected $url = "/";
    /** @var Method */
    protected $Method;
    /** @var string */
    protected $ContentType;
    /** @var Registry */
    protected $ParamsRegistry;

    /**
     * UrlRequest constructor.
     */
    public function __construct()
    {
        $this->setMethod( new Method() );
        $this->setParamsRegistry( new Registry() );

        if ( $_posts = json_decode( file_get_contents("php://input") , true ) )
            foreach ( $_posts AS $key => $value )
                $this->setParam( $key , $value );
    }

    /**
     * @param string $url
     * @return UrlRequest
     */
    public function setUrl( $url )
    {
        // Supprime le dernier "/"
        $url = str_replace( "//" , "/" , $url );
        $url = ( $url != "/" ) ? rtrim( $url , "/" ) : $url;
        $this->url = $url;
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
     * @param Method $method
     * @return UrlRequest
     */
    public function setMethod( Method $method )
    {
        $this->Method = $method;
        return $this;
    }

    /**
     * @return Method
     */
    public function getMethod()
    {
        return $this->Method;
    }

    /**
     * @param string $ContentType
     * @return UrlRequest
     */
    public function setContentType( $ContentType )
    {
        $this->ContentType = $ContentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->ContentType;
    }

    /**
     * @param Registry $paramsRegistry
     * @return UrlRequest
     */
    public function setParamsRegistry( Registry $paramsRegistry )
    {
        $this->ParamsRegistry = $paramsRegistry;
        return $this;
    }

    /**
     * @return Registry
     */
    public function getParamsRegistry()
    {
        return $this->ParamsRegistry;
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return $this
     * @throws \MonoKit\Component\Registry\Exception\RegistryException
     */
    public function setParam( $key , $value = null )
    {
        $this->getParamsRegistry()->set( $key , $value );
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \MonoKit\Component\Registry\Exception\RegistryException
     */
    public function getParam( $key )
    {
        return $this->getParamsRegistry()->get( $key );
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasParam( $key )
    {
        return $this->getParamsRegistry()->has( $key );
    }

    /**
     * @return bool
     */
    public function isJson()
    {
        return ( $this->getContentType() == "application/json" || $this->getParamsRegistry()->hasKey("JSON") ) ? true : false;
    }

}