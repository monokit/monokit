<?php

namespace MonoKit\Routing;

use MonoKit\Http\UrlRequest;
use MonoKit\EntityManager\EntityManager;

Class RouteManager extends EntityManager
{
    /**
     * @param Route $route
     * @return RouteManager
     */
    public function addRoute( Route $route )
    {
        return parent::add( $route );
    }

    /**
     * @param string $name
     * @return Route
     */
    public function getRouteByName( $name )
    {
        return $this->find( "name" , strtoupper( $name ) )->getFirst();
    }

    /**
     * @param UrlRequest $urlRequest
     * @return Route|null
     */
    public function getRouteByUrlRequest( UrlRequest $urlRequest )
    {
        foreach( $this AS $route )
            if ( $route->getMethod()->is( $urlRequest->getMethod()->getMethod() ) && $this->comparePattern( $route , $urlRequest ) )
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


}