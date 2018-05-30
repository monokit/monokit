<?php

namespace MonoKit\Controller;

use MonoKit\Component\Image\Image;
use MonoKit\Component\Image\ImageResource;
use MonoKit\Http\Response\ResponseImageResource;

Abstract Class ImageController extends Controller
{
    /**
     * @param string $imagePath
     * @param string $type
     * @return ResponseImageResource
     */
    protected function getImageResource( $imagePath , $type = Image::SRC )
    {
        $ImageResource = new ImageResource( $imagePath );

        switch ( $type )
        {
            case Image::THUMB:
                $ImageResource->setMaxSize( Image::THUMB_SIZE );
                break;

            case Image::SQUARE:
                $ImageResource->square( Image::SQUARE_SIZE );
                break;

            default:
                $ImageResource->setMaxSize( Image::MAX_SIZE );
        }

        return new ResponseImageResource( $ImageResource );
    }
}