<?php

namespace MonoKit\Http;

use MonoKit\Manager\EntityManager;

Class RouteManager extends EntityManager
{
    /**
     * @param Route $route
     * @return RouteManager
     */
    public function add( Route $route )
    {
        return parent::add( $route );
    }

    /**
     * @param array $array
     * @return RouteManager
     */
    public function set( array $array = array() )
    {
        $this->removeAll();

        foreach( $array AS $routeName => $routeArray )
        {
            $route = new Route();
            $route->setName( $routeName );
            $route->setProperties( $routeArray );

            $this->add( $route );
        }

        return $this;
    }

    /**
     * @param string $name
     * @return Route
     */
    public function getRouteByName( $name )
    {
        $array = $this->find( "name" , $name );
        return $array[0];
    }

    /**
     * @param UrlRequest $urlRequest
     * @return Route|null
     */
    public function getRouteByUrlRequest( UrlRequest $urlRequest )
    {
        foreach( $this AS $route )
            if ( $this->comparePattern( $route , $urlRequest ) && $this->compareMethod( $route , $urlRequest ) )
                return $route;

        return null;
    }

    /**
     * @param Route $route
     * @param UrlRequest $urlRequest
     * @return int
     */
    public function comparePattern( Route $route , UrlRequest $urlRequest )
    {
        return preg_match( $route->getPattern() , $urlRequest->getUrl() );
    }

    /**
     * @param Route $route
     * @param UrlRequest $urlRequest
     * @return bool
     */
    public function compareMethod( Route $route , UrlRequest $urlRequest )
    {
        return ( $route->getMethod() == $urlRequest->getMethod() ) ? true : false;
    }

    /**
     * @return Route
     */
    public function current()
    {
        return parent::current();
    }

}