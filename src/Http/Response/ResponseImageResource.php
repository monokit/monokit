<?php

namespace MonoKit\Http\Response;

use MonoKit\Component\Image\ImageResource;
use MonoKit\Http\Header;

Class ResponseImageResource extends Response
{
    /** @var ImageResource */
    private $imageResource;

    /**
     * ResponseImageResource constructor.
     * @param ImageResource $imageResource
     * @param int $status
     */
    public function __construct( ImageResource $imageResource , $status = self::HTTP_OK )
    {
        $this->imageResource = $imageResource;

        parent::__construct( $this->imageResource->getResource() , $status );

        if ( $this->imageResource->isImageType( ImageResource::TYPE_PNG ) )
        {
            $this->addHeader( new Header( "Content-Type" , "image/png" ) );
        } else {
            $this->addHeader( new Header( "Content-Type" , "image/jpg" ) );
        }
    }

    /**
     * @param null $viewFile
     */
    public function render( $viewFile = null )
    {
        if ( $this->imageResource->isImageType( ImageResource::TYPE_PNG ) )
        {
            imagealphablending( $this->getContent() , false);
            imagesavealpha( $this->getContent() , true);
            imagepng( $this->getContent() );
        } else {
            imagejpeg( $this->getContent() );
        }

        imagedestroy($this->getContent());
    }
}