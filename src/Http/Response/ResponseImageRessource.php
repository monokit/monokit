<?php

namespace MonoKit\Http\Response;

use MonoKit\Component\Image\ImageResource;

Class ResponseImageRessource extends Response
{
    const CONTENT_TYPE = "image/jpg";

    /**
     * ResponseImageRessource constructor.
     * @param ImageResource $imageRessource
     * @param int $status
     */
    public function __construct( ImageResource $imageRessource, $status = self::HTTP_OK )
    {
        parent::__construct( $imageRessource->getImage() , $status );
    }

    /**
     * @param null $viewFile
     */
    public function render($viewFile = null)
    {
        imagejpeg( $this->getContent() );
        imagedestroy($this->getContent() );
    }
}