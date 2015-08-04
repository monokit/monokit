<?php

namespace MonoKit;

use MonoKit\Foundation\Foundation;
use MonoKit\Http\Response\Response;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Registry\RegistryException;
use MonoKit\Http\Dispatcher;
use MonoKit\Http\RouteManager;
use MonoKit\Http\UrlRequest;
use MonoKit\View\View;

Class MonoKitApplication extends Foundation
{
    /**
     * @param string|null $fileView
     * @param mixed|null $data
     * @return Response|null
     * @throws RegistryException
     */
    public function render( $fileView = null , $data = null )
    {
        if ( !$this->AppRegistry( "APPLICATION.NAMESPACE" ) )
            throw new RegistryException( RegistryException::ERROR_APPLICATION_NAMESPACE , $this , $this->AppRegistry() );

        $UrlRequest = new UrlRequest();
        $UrlRequest->autoDetect();

        $RouteManager = new RouteManager();
        $RouteManager->set( $this->AppRoute()->toArray() );

        $Dispatcher = new Dispatcher( $UrlRequest , $RouteManager );
        $Response = $Dispatcher->getResponse();

        if ( $Response instanceof ResponseHtml && $fileView )
        {
            define( "HTML_CONTENT" , $Response->getContent() );

            return new View( $fileView , $data );
        }

        echo $Response->getContent();

        return $Response->getContent();
    }
}



?>