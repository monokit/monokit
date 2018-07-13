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
    public function setParamsRegistry( Registry $paramsRegistry)
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
     * @param mixed $value
     * @return UrlRequest
     * @throws \MonoKit\Component\Registry\Exception\RegistryException
     */
    public function setParameter( $key , $value = null )
    {
        $this->getParamsRegistry()->set( $key , $value );
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \MonoKit\Component\Registry\Exception\RegistryException
     */
    public function getParameter( $key )
    {
        return $this->getParamsRegistry()->get( $key );
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasParameter( $key )
    {
        return $this->getParamsRegistry()->has( $key );
    }

    /**
     * @param array $array
     * @return UrlRequest
     */
    public function setParameters( array $array )
    {
        $this->ParamsRegistry->map( $array );
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->getParamsRegistry()->toArray();
    }

    /**
     * @return bool
     */
    public function isJson()
    {
        return ( $this->getContentType() == "application/json" || $this->getParamsRegistry()->hasKey("JSON") ) ? true : false;
    }

}