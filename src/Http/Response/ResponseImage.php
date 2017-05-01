<?php

namespace MonoKit\Http\Response;

use MonoKit\Component\File\Image;

Class ResponseImage extends Response
{
    const CONTENT_TYPE = "image/jpg";

    public function __construct( Image $image , $status = 200 )
    {
        if ( !$image->isFile() )
            $this->setStatus( 404 );

        parent::__construct( $image->getImage() , $this->getStatus() );
    }

    public function render( $imageFile = null )
    {
        if ( $this->getContent() )
        {
            imagejpeg( $this->getContent() );
            imagedestroy($this->getContent() );
        }

    }
}