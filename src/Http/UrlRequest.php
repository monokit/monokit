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
    /** @var Registry */
    protected $ParamsRegistry;

    /**
     * UrlRequest constructor.
     */
    public function __construct()
    {
        $this->Method           = new Method();
        $this->ParamsRegistry   = new Registry();
    }

    /**
     * @param string $url
     * @return UrlRequest
     */
    public function setUrl( $url )
    {
        // Supprime le dernier "/"
        $url = ( $url != "/" ) ? rtrim( $url , "/" ) : $url;
        $this->url = str_replace( "//" , "/" , $url );;
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



}