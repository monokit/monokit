<?php

namespace MonoKit\File;

class Asset extends File
{
    /** @var string */
    protected $url;
    /** @var string */
    protected $appName;

    /**
     * Asset constructor.
     * @param string $url
     */
    public function __construct( $url )
    {
        $url = ltrim( $url , "/" );

        preg_match('/@(?P<AppName>\w+)\//', $url , $matches );

        if ( isset( $matches["AppName"] ) )
        {
            $this->setAppName( $matches["AppName"] );

            $urlArray = explode("@{$this->getAppName()}/" , $url , 2 );

            $this->setUrl( "../../{$this->getAppName()}/Assets/{$urlArray[1]}" );

        } else {
            $this->setUrl( $url );
        }

        parent::__construct( $this->getUrl() );
    }

    /**
     * @param $appName
     * @return Asset
     */
    public function setAppName( $appName )
    {
        $this->appName = $appName;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * @param string $url
     * @return Asset
     */
    public function setUrl( $url )
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function render()
    {
        if ( $this->isFile() )
        {
            header( "Content-type:".$this->getMimeType() );
            echo $this->getFileContent();
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
}