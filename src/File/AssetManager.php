<?php

namespace MonoKit\File;

use MonoKit\Manager\EntityManager;

class AssetManager extends EntityManager
{
    /**
     * @param string $directory
     * @return AssetManager
     * @throws AssetException
     */
    public function getAssetsFromDirectory( $directory )
    {
        preg_match('/@(?P<AppName>\w+)\//', $directory , $matches );

        if ( !isset( $matches["AppName"] ) || substr( $directory , 0 , 1) != "@" )
            throw new AssetException( AssetException::ERROR_ASSET_NAME , $this , $directory );

        $urlArray = explode("@{$matches['AppName']}/" , $directory , 2 );

        if ( is_dir( $dir = __SRC__ . "{$matches['AppName']}/Assets/{$urlArray[1]}" ) )
            foreach (scandir($dir) AS $asset)
            {
                if (substr($asset, 0, 1) != ".")
                {
                    $Asset = new Asset( $directory . "/" . $asset);

                    if ($Asset->isFile())
                        $this->add($Asset);
                }
            }

        return $this;
    }
}