<?php

namespace MonoKit\Component\Image;

use MonoKit\Component\File\File;
use MonoKit\EntityManager\Entity;

Class ImageResource extends Entity
{
    /** @var resource */
    protected $image;

    /**
     * ImageResource constructor.
     * @param string $filePath
     */
    public function __construct( $filePath = null )
    {
        $this->setImage( imagecreate( 100 , 100) );

        if ( !is_null($filePath) )
            $this->setImageFromFile( new File( $filePath ) );
    }

    /**
     * @param resource $image
     * @return ImageResource
     */
    public function setImage( $image )
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return resource
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param File $file
     * @return ImageResource
     */
    public function setImageFromFile( File $file )
    {
        if ( $file->isFile() )
            $this->image = imagecreatefromjpeg( $file->getFilePath() );

        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return ImageResource
     */
    public function resize( $width , $height )
    {
        $image = imagecreatetruecolor( (int) $width , (int) $height );
                 imagecopyresampled( $image , $this->getImage(), 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());

        $this->setImage( $image );

        return $this;
    }

    /**
     * @param int $degrees
     * @return ImageResource
     */
    public function rotate( $degrees )
    {
        $this->setImage( imagerotate( $this->getImage() , -$degrees , 0 ) );
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

        imagecopyresampled( $image , $this->getImage(), 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->setImage( $image );

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
            $smallestSide = $height;
        } else {
            $x = 0;
            $y = ($height - $width) / 2;
            $smallestSide = $width;
        }

        $image = imagecreatetruecolor( $size , $size );
        imagecopyresampled($image, $this->getImage(), 0, 0, $x, $y, $size, $size, $smallestSide, $smallestSide);

        $this->setImage( $image );

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return imagesx( $this->getImage() );
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return imagesy( $this->getImage() );
    }

    /**
     * @return float
     */
    protected function getRatio()
    {
        return $this->getHeight() / $this->getWidth();
    }

    /**
     * @return ImageResource
     */
    public function save( $filePath )
    {
        imagejpeg( $this->getImage() , $filePath );
        return $this;
    }
}