<?php

namespace MonoKit;

use MonoKit\Foundation\Foundation;
use MonoKit\Registry\RegistryException;
use MonoKit\Http\Dispatcher;
use MonoKit\Http\RouteManager;
use MonoKit\Http\UrlRequest;
use MonoKit\View\View;

Class MonoKitApplication extends Foundation
{
    /**
     * @param string $appNamespace
     * @return MonoKitApplication
     */
    public function setAppNamespace( $appNamespace )
    {
        $this->AppRegistry( "APPLICATION_NAMESPACE" , $appNamespace );
        return $this;
    }

    /**
     * @param string|null $fileView
     * @param mixed|null $data
     * @return mixed
     * @throws RegistryException
     */
    public function render( $fileView = null , $data = null )
    {
        if ( !$this->AppRegistry( "APPLICATION.NAMESPACE" ) )
            throw new RegistryException( RegistryException::ERROR_APPLICATION_NAMESPACE , $this , $this->AppRegistry() );

        $UrlRequest = new UrlRequest();
        $UrlRequest->autoDetect();

        $RouteManager = new RouteManager();
        $RouteManager->set( $this->RouteRegistry()->toArray() );

        $Dispatcher = new Dispatcher( $UrlRequest , $RouteManager );

        if ( $fileView )
        {
            define( "HTML_CONTENT" , $Dispatcher->getResponse() );

            $view = new View();
            return $view->render( $fileView , $data );
        }

        return $Dispatcher->getResponse();

    }
}



?>