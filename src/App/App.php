<?php

namespace MonoKit\App;

use MonoKit\View\View;
use MonoKit\Http\Dispatcher;
use MonoKit\Http\UrlRequestDiscover;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Foundation\Foundation;

Abstract Class App extends Foundation
{
    /**
     * @param null $fileView
     * @param null $data
     * @return mixed|View
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

    /**
     * @param $iniFile
     * @return App
     * @throws \MonoKit\File\FileException
     */
    public function setAppRegistryFromIniFile( $iniFile )
    {
        $this->AppRegistry()->setFromIniFile( $iniFile );
        return $this;
    }

    /**
     * @param string $iniFile
     * @return App
     * @throws \MonoKit\File\FileException
     */
    public function setAppRouterFromIniFile( $iniFile )
    {
        $this->AppRouter()->setFromIniFile( $iniFile );
        return $this;
    }

}