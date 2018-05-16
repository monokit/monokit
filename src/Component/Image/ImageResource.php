<?php

namespace MonoKit\Component\Image;

use MonoKit\Component\File\File;
use MonoKit\EntityManager\Entity;

Class ImageResource extends Entity
{
    /** @var resource */
    protected $resource;
    /** @var int */
    protected $quality = 80;

    /**
     * ImageResource constructor.
     * @param string $filePath
     */
    public function __construct( $filePath = null )
    {
        $this->setResource( imagecreate( 100 , 100 ) );

        if ( !is_null($filePath) )
            $this->setResourceFromFile( new File( $filePath ) );
    }

    /**
     * @param resource $resource
     * @return ImageResource
     */
    public function setResource( $resource )
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @param File $file
     * @return ImageResource
     */
    public function setResourceFromFile( File $file )
    {
        if ( $file->isFile() )
            $this->resource = imagecreatefromjpeg( $file->getFilePath() );

        return $this;
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param int $quality
     * @return ImageResource
     */
    public function setQuality( $quality )
    {
        $this->quality = (int) $quality;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param int $width
     * @param int $height
     * @return ImageResource
     */
    public function resize( $width , $height )
    {
        $image = imagecreatetruecolor( (int) $width , (int) $height );
                 imagecopyresampled( $image , $this->getResource(), 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight() );

        $this->setResource( $image );

        return $this;
    }

    /**
     * @param int $degrees
     * @return ImageResource
     */
    public function rotate( $degrees )
    {
        $this->setResource( imagerotate( $this->getResource() , -$degrees , 0 ) );
        return $this;
    }

    /**
     * @param int $max
     * @return ImageResource
     */
    public function setMaxSize( $max )
    {
        $ratio = $this->getRatio();

        if ( $ratio <= 1 ) // WIDTH PLUS GRAND
        {
            $width = $max;
            $height = $max * $ratio;

            $image = imagecreatetruecolor( $max , $height );
        } else {
            $width = $max / $ratio;
            $height = $max;

            $image = imagecreatetruecolor( $width , $height );
        }

        imagecopyresampled( $image , $this->getResource(), 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->setResource( $image );

        return $this;
    }

    /**
     * @param int $size
     * @return ImageResource
     */
    public function square( $size )
    {
        $ratio = $this->getRatio();

        $width = $this->getWidth();
        $height = $this->getHeight();

        if( $ratio <= 1 ) // WIDTH PLUS GRAND
        {
            $y = 0;
            $x = ($width - $height) / 2;
            $smallestSide = $height * .99;
        } else {
            $x = 0;
            $y = ($height - $width) / 2;
            $smallestSide = $width * .99;
        }

        $image = imagecreatetruecolor( $size , $size );
        imagecopyresampled($image, $this->getResource(), 0, 0, $x, $y, $size, $size, $smallestSide, $smallestSide);

        $this->setResource( $image );

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return imagesx( $this->getResource() );
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return imagesy( $this->getResource() );
    }

    /**
     * @return float
     */
    protected function getRatio()
    {
        return $this->getHeight() / $this->getWidth();
    }

    /**
     * @param string $filePath
     * @return ImageResource
     */
    public function save( $filePath )
    {
        imagejpeg( $this->getResource() , $filePath , $this->quality );
        return $this;
    }
}