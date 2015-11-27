<?php

namespace MonoKit\File;

class Asset extends File
{
    /** @var string */
    protected $asset;

    /**
     * Asset constructor.
     * @param string $asset
     * throws AssetException
     */
    public function __construct( $asset )
    {
        preg_match('/@(?P<AppName>\w+)\//', $asset , $matches );

        if ( !isset( $matches["AppName"] ) || substr( $asset , 0 , 1) != "@" )
            throw new AssetException( AssetException::ERROR_ASSET_NAME , $this , $asset );

        $this->asset = $asset;

        $urlArray = explode("@{$matches['AppName']}/" , $this->asset , 2 );

        parent::__construct( __SRC__ . "{$matches['AppName']}/Assets/{$urlArray[1]}" );
    }

    /**
     * @return null|string
     */
    public function getAsset()
    {
        return ( $this->isFile() ) ? $this->asset : null;
    }
}