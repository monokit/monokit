<?php

namespace MonoKit;

use MonoKit\Foundation\Foundation;
use MonoKit\Registry\RegistryException;
use MonoKit\Http\Response\Response;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Http\Dispatcher;
use MonoKit\Http\UrlRequest;
use MonoKit\View\View;

Class MonoKitApplication extends Foundation
{
    /**
     * @param string $mode
     */
    public function __construct( $mode = 'DEV' )
    {
        $this->setMode( $mode );
    }

    /**
     * @param string $mode
     * @return MonoKitApplication
     */
    public function setMode( $mode = 'DEV' )
    {
        switch( $mode )
        {
            case 'DEV':
                error_reporting(-1);
                break;

            default:
                error_reporting(0);
        }

        return $this;
    }

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

        $Dispatcher = new Dispatcher( $UrlRequest );
        $Response = $Dispatcher->getResponse();

        if ( $fileView && $Response instanceof ResponseHtml )
        {
            define( "HTML_CONTENT" , $Response->getContent() );

            return new View( $fileView , $data );
        }

        echo $Response->getContent();

        return $Response->getContent();
    }
}

?>