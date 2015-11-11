<?php

namespace MonoKit\Http;

use MonoKit\Foundation\Foundation;
use MonoKit\Controller\Controller;
use MonoKit\Controller\ControllerException;
use MonoKit\Http\Response\Response;

Class Dispatcher extends Foundation
{
    /** @var Controller */
    protected $controller;
    /** @var string */
    protected $action;

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
        $controller = $this->AppRegistry( "APPLICATION.NAMESPACE" ) . "\\Controller\\" . $controllerName;

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
     * @param UrlRequest $urlRequest
     * @return mixed|Response
     * @throws ControllerException
     */
    public function getResponse( UrlRequest $urlRequest )
    {
        if ( !$route = $this->AppRouter()->getRouteByUrlRequest( $urlRequest ) )
        { // HTTP RESPONSE CODE(404)
            header("HTTP/1.0 404 Not Found");
            $this->setControllerFromString( "AppController" );
            $this->setAction( "error404" );

            $content = call_user_func( array( $this->getController() , $this->getAction() ) );
        }
        else
        { // HTTP RESPONSE CODE(200)
            $this->setControllerFromString( $route->getControllerName() );
            $this->setAction( $route->getActionName() );

            $content = call_user_func_array( array( $this->getController() , $this->getAction() ) , $route->getUrlRequest()->getParametersValue( $urlRequest ) );
        }

        if ( $content instanceof Response )
            return $content;

        return new Response( $content );

    }

}