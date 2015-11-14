<?php

namespace MonoKit\App;

use MonoKit\File\File;
use MonoKit\View\View;
use MonoKit\Http\Dispatcher;
use MonoKit\Http\UrlRequestDiscover;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Foundation\Foundation;

Abstract Class App extends Foundation
{
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
     * @param $fileUrl
     * @return bool|string
     */
    public function renderAsset( $fileUrl )
    {
        $fileUrl = ltrim( $fileUrl , "/" );

        preg_match('/@(?P<AppName>\w+)\//', $fileUrl , $matches );

        if ( isset( $matches["AppName"] ) )
        {
            $urlArray = explode("@{$matches['AppName']}/" , $fileUrl , 2 );
            $url = "../../{$matches['AppName']}/Assets/{$urlArray[1]}";
        } else {
            $url = __DIR__ . "/Assets/" . $fileUrl;
        }

        $File = new File( $url );

        if ( $File->isFile() )
        {
            header( "Content-type:".$File->getMimeType() );
            echo $File->getFileContent();
        } else {
            header("HTTP/1.0 404 Not Found");
        }

        return false;
    }

}