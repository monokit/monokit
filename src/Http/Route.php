<?php

namespace MonoKit\Http;

use MonoKit\Manager\Entity;

Class Route extends Entity
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $pattern;
	/** @var string */
	protected $controllerName;
    /** @var string */
    protected $actionName;
    /** @var UrlRequest */
    protected $UrlRequest;

    public function __construct()
    {
        $this->UrlRequest = new UrlRequest();
    }

    /**
     * @param string $name
     * @return Route
     */
    public function setName( $name )
    {
        $this->name = strtoupper($name);
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $pattern
     * @return Route
     */
    public function setPattern( $pattern )
    {
        $this->UrlRequest->setUrl( $pattern );

        $pattern = strtolower( $pattern );

        $patterns = array();
        $patterns[] = '#{[\w+]+}#';
        $patterns[] = '#{[\w+]+:int}#';
        $patterns[] = '#{[\w+]+:string}#';

        $replaces = array();
        $replaces[] = '[\w\+_\-àâéèêëùïü\'\(\)]+';
        $replaces[] = '[\d]+';
        $replaces[] = '[\D]+';

        $this->pattern = "#^".preg_replace( $patterns , $replaces , $pattern )."$#";

        return $this;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $action
     * @return Route
     */
    public function setAction( $action )
    {
        // controller:action
        if ( !strpos( $action , MONOKIT_APPLICATION_ROUTE_SEPARATOR ) )
            return $this->setActionName( $action );

        // method
        list( $controllerName , $actionName ) = explode( MONOKIT_APPLICATION_ROUTE_SEPARATOR , $action );

        $this->setControllerName( $controllerName );
        $this->setActionName( $actionName );

        return $this;
    }

    /**
     * @param string $controllerName
     * @return Route
     */
    public function setControllerName( $controllerName )
    {
        $this->controllerName = $controllerName;
        return $this;
    }

    /**
     * @return string
     */
	public function getControllerName()
	{
		return $this->controllerName;
	}

    /**
     * @param string $actionName
     * @return Route
     */
    public function setActionName( $actionName )
    {
        $this->actionName = $actionName;
        return $this;
    }

    /**
     * @return string
     */
	public function getActionName()
	{
		return $this->actionName;
	}

    /**
     * @param string $method
     * @return Route
     */
    public function setMethod( $method = "GET" )
    {
        $this->UrlRequest->setMethod( $method );
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->UrlRequest->getMethod();
    }

    /**
     * @param UrlRequest $urlRequest
     * @return Route
     */
    public function setUrlRequest( UrlRequest $urlRequest )
    {
        $this->UrlRequest = $urlRequest;
        return $this;
    }

    /**
     * @return UrlRequest
     */
    public function getUrlRequest()
    {
        return $this->UrlRequest;
    }

}

?>