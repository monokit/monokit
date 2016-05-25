<?php

namespace MonoKit\Routing;

use MonoKit\Http\Method;
use MonoKit\Http\UrlRequest;
use MonoKit\EntityManager\Entity;

Class Route extends Entity
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $url;
    /** @var string */
    protected $pattern;
	/** @var string */
	protected $controllerName;
    /** @var string */
    protected $actionName;
    /** @var Method */
    protected $Method;

    /**
     * Route constructor.
     * @param string $name
     * @param string $pattern
     * @param string $method
     */
    public function __construct( $name , $pattern = "/" , $method = "GET"  )
    {
        $this->setName( $name );
        $this->setPattern( $pattern );
        $this->setMethod( $method );
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
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Route
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $pattern
     * @return Route
     */
    public function setPattern( $pattern )
    {
        $this->setUrl( $pattern );

        $patterns = array();
        $patterns[] = '#{[\w+]+}#';
        $patterns[] = '#{[\w+]+:int}#';
        $patterns[] = '#{[\w+]+:string}#';

        $replaces = array();
        $replaces[] = '[\w\+_\-àâéèêëùïü\.\'\(\)]+';
        $replaces[] = '[\d]+';
        $replaces[] = '[\D]+';

        $this->pattern = '#^'.preg_replace( $patterns , $replaces , $pattern ).'$#i';

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
        if ( !strpos( $action , __ROUTE_SEPARATOR__ ) )
            return $this->setActionName( $action );

        // method
        list( $controllerName , $actionName ) = explode( __ROUTE_SEPARATOR__ , $action );

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
    public function setMethod( $method )
    {
        $this->Method = new Method( $method );
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
     * Retourne un tableau contenant tous les paramètres trouvés dans l'url fournie.
     *
     * @param UrlRequest $urlRequest
     * @return array
     */
    public function getParameters( UrlRequest $urlRequest )
    {
        return array_udiff( explode( "/" , $urlRequest->getUrl() ) , explode( "/" , $this->getUrl() ) , 'strcasecmp' );
    }

}