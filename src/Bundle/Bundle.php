<?php

namespace MonoKit\Bundle;

use MonoKit\View\View;
use MonoKit\Http\Dispatcher;
use MonoKit\Http\UrlRequestDiscover;
use MonoKit\Http\Response\Response;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Registry\RegistryException;
use MonoKit\Foundation\Foundation;

Abstract Class Bundle extends Foundation
{
    /**
     * @param string|null $fileView
     * @param mixed|null $data
     * @return Response|null
     * @throws RegistryException
     */
    public function render( $fileView = null , $data = null )
    {
        $Dispatcher = new Dispatcher();
        $UrlRequest = new UrlRequestDiscover();

        $Response = $Dispatcher->getResponse( $UrlRequest , $this );

        if ( $fileView && $Response instanceof ResponseHtml )
        {
            define( "HTML_CONTENT" , $Response->getContent() );

            return new View( $fileView , $data );
        }

        echo $Response->getContent();

        return $Response->getContent();
    }

}