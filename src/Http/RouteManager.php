<?php

namespace MonoKit\Http;

use MonoKit\File\File;
use MonoKit\File\FileException;
use MonoKit\Manager\EntityManager;

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
     * @param string $iniFile
     * @return RouteManager
     * @throws FileException
     */
    public function setFromIniFile( $iniFile )
    {
        $file = new File( $iniFile );

        if ( !$file->isFile() )
            throw new FileException( FileException::ERROR_LOADING_FILE , $this , $file );

        foreach( parse_ini_file( $file->getFile() , true ) AS $routeName => $routeArray )
        {
            $route = new Route( $routeName );
            $route->setProperties( $routeArray );

            $this->addRoute( $route );
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