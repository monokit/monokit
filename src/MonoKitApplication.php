<?php

namespace MonoKit;

use MonoKit\Foundation\Foundation;
use MonoKit\Http\Response\Response;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Http\Dispatcher;
use MonoKit\Http\UrlRequest;
use MonoKit\View\View;

Class MonoKitApplication extends Foundation
{
    /**
     * @param string $namespace
     */
    public function __construct( $namespace )
    {
        $this->AppRegistry( "APPLICATION.NAMESPACE" , $namespace );
    }

    /**
     * @param string|null $fileView
     * @param mixed|null $data
     * @return Response|null
     */
    public function render( $fileView = null , $data = null )
    {
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