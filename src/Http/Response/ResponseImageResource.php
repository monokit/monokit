<?php

namespace MonoKit\Http\Response;

use MonoKit\Component\Image\ImageResource;

Class ResponseImageResource extends Response
{
    const CONTENT_TYPE = "image/jpg";

    /**
     * ResponseImageResource constructor.
     * @param ImageResource $imageResource
     * @param int $status
     */
    public function __construct( ImageResource $imageResource, $status = self::HTTP_OK )
    {
        parent::__construct( $imageResource->getResource() , $status );
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