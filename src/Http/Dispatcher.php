<?php

namespace MonoKit\Http;

use MonoKit\Foundation\Foundation;
use MonoKit\Controller\Controller;
use MonoKit\Controller\ControllerException;
use MonoKit\Http\Response\Response;

Class Dispatcher extends Foundation
{
    /** @var RouteManager */
    protected $routeManager;
    /** @var UrlRequest */
    protected $urlRequest;
    /** @var Controller */
    protected $controller;
    /** @var string */
    protected $action;

    /**
     * @param RouteManager $routeManager
     * @param UrlRequest $urlRequest
     */
    public function __construct( UrlRequest $urlRequest , RouteManager $routeManager )
    {
        $this->setUrlRequest( $urlRequest );
        $this->setRouteManager( $routeManager );
    }

    /**
     * @param RouteManager $routeManager
     * @return Dispatcher
     */
    public function setRouteManager( RouteManager $routeManager )
    {
        $this->routeManager = $routeManager;
        return $this;
    }

    /**
     * @return RouteManager
     */
    public function getRouteManager()
    {
        return $this->routeManager;
    }

    /**
     * @param UrlRequest $urlRequest
     * @return Dispatcher
     */
    public function setUrlRequest( UrlRequest $urlRequest )
    {
        $this->urlRequest = $urlRequest;
        return $this;
    }

    /**
     * @return UrlRequest
     */
    public function getUrlRequest()
    {
        return $this->urlRequest;
    }

    /**
     * @param Controller $controller
     * @return Dispatcher
     */
    protected function setController( Controller $controller )
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param string $controllerName
     * @return Dispatcher
     * @throws ControllerException
     */
    protected function setControllerFromString( $controllerName )
    {
        $controller = $this->AppRegistry( "APPLICATION.NAMESPACE" ) . "\\" . MONOKIT_APPLICATION_DIRECTORY_CONTROLLER . "\\" . $controllerName;

        if ( !class_exists( $controller ) )
            throw new ControllerException( ControllerException::ERROR_CONTROLLER , $this , $controller );

        $this->setController( new $controller() );

        return $this;
    }

    /**
     * @return Controller
     */
    protected function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $actionName
     * @return Dispatcher
     * @throws ControllerException
     */
    protected function setAction( $actionName )
    {
        if ( !method_exists( $this->getController() , $actionName ) )
            throw new ControllerException( ControllerException::ERROR_METHOD , $this->getController() , $actionName );

        $this->action = $actionName;

        return $this;
    }

    /**
     * @return string
     */
    protected function getAction()
    {
        return $this->action;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        //http_response_code(404);
        if ( !$route = $this->getRouteManager()->getRouteByUrlRequest( $this->getUrlRequest() ) )
        {
            header("HTTP/1.0 404 Not Found");
            $this->setControllerFromString( "AppController" );
            $this->setAction( "error404" );

            $content = call_user_func( array( $this->getController() , $this->getAction() ) );
        } else {
            //http_response_code(200);
            $this->setControllerFromString( $route->getControllerName() );
            $this->setAction( $route->getActionName() );

            $content = call_user_func_array( array( $this->getController() , $this->getAction() ) , $route->getUrlRequest()->getParametersValue( $this->getUrlRequest() ) );
        }

        if ( $content instanceof Response )
            return $content;

        return new Response( $content );

    }

}

?>