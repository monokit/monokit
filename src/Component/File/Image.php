<?php

namespace MonoKit\Component\File;

Class Image extends File
{
    /** @var resource */
    protected $image;

    /**
     * Image constructor.
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        parent::__construct($filePath);

        if ( $this->isFile() )
            $this->image = imagecreatefromjpeg( $this->filePath );
    }

    /**
     * @param Resource $image
     * @return $this
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
     * @param int $width
     * @param int $height
     * @return Image
     */
    public function resize( $width , $height )
    {
        $image = imagecreatetruecolor( $width , $height );
        imagecopyresampled( $image, $this->getImage(), 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());

        $this->setImage( $image );

        return $this;
    }

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
     * @param int $degrees
     * @return Image
     */
    public function rotate( $degrees )
    {
        $this->setImage( imagerotate( $this->getImage() , $degrees , 0 ) );
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
        if ( !$this->isFile() )
            return false;

        return $this->getHeight() / $this->getWidth();
    }

}