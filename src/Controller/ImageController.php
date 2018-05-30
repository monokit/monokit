<?php

namespace MonoKit\Controller;

use MonoKit\Component\Image\Image;
use MonoKit\Component\Image\ImageResource;
use MonoKit\Http\Response\ResponseImageResource;

Abstract Class ImageController extends Controller
{
    /**
     * @param string $filePath
     * @param string $type
     * @return ResponseImageResource
     */
    protected function getImageResourceFromFilePath( $filePath , $type = Image::SRC )
    {
        $ImageResource = new ImageResource( $filePath );

        switch ( $type )
        {
            case Image::THUMB:
                $ImageResource->setMaxSize( Image::THUMB_SIZE );
                break;

            case Image::SQUARE:
                $ImageResource->square( Image::SQUARE_SIZE );
                break;

            default:
                $ImageResource->setMaxSize( Image::SRC_SIZE );
        }

        return new ResponseImageResource( $ImageResource );
    }
}