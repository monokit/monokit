<?php

namespace MonoKit\File;

use MonoKit\Utility\Dimension;

/**
 * Cette classe gère une image sélectionnée sur le serveur.
 *
 * @author Micka VAN HAREN
 * @version 07/2015
 */
Class FileImage extends File
{
	/** @var array */
	protected $imageInfo;
	/** @var int */
	protected $quality = 80;

	/**
	 * @param string $file
	 */
	public function __construct( $file )
	{
		parent::__construct( $file );

		if ( $this->isFile() )
			$this->imageInfo = getimagesize( $this->file );
	}

	/**
	 * @param int $quality
	 * @return FileImage
	 */
	public function setQuality( $quality = 80 )
	{
		$this->quality = $quality;
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
	 * @return int
	 */
	public function getWidth()
	{
		$imageInfo = getimagesize( $this->file );
		return $imageInfo['width'];
	}

	/**
	 * @return bool|int
	 */
	public function getHeight()
	{
		$imageInfo = getimagesize( $this->file );
		return $imageInfo['height'];
	}

	/**
	 * @return bool
	 */
	public function getType()
	{
		$imageInfo = getimagesize( $this->file );
		return $imageInfo['type'];
	}

	/**
	 * @return bool|float
	 */
    public function getRatio()
    {
		if ( !$this->isFile() )
			return false;

        return $this->getHeight() / $this->getWidth();
    }

	/**
	 * @return bool|Dimension
	 */
	public function getDimension()
    {
		if ( !$this->isFile() )
			return false;

        return new Dimension( $this->getWidth() , $this->getHeight() );
    }

	/**
	 * @param int $width
	 * @param int $height
	 * @return FileImage
	 */
	public function resize( $width , $height )
	{
		if ( !$this->isFile() )
			return false;

		$img = imagecreatetruecolor( $width , $height );
		imagecopyresampled( $img , $this->getGdImage() , 0 , 0 , 0 , 0 , $width , $height , $this->getWidth() , $this->getHeight() );

		$this->getImageResult( $img );

		return $this;
	}

	/**
	 * @param int $sizeMax
	 * @return FileImage
	 */
	public function resizeMax( $sizeMax = 256 )
	{
		if ( !$this->isFile() )
			return false;

		if ( $this->getWidth() > $this->getHeight() )
		{
			$nWidth = (int) $sizeMax;
			$nHeight = (int) ( $sizeMax * $this->getRatio() );
		} else {
			$nWidth = (int) ( $sizeMax / $this->getRatio() );
			$nHeight = (int) $sizeMax;
		}

		return $this->resize( $nWidth , $nHeight );
	}

	/**
	 * @param int $degree
	 * @return FileImage
	 */
	public function rotate( $degree )
	{
		if ( !$this->isFile() )
			return false;

		$img = imagerotate( $this->getGdImage() , (int) $degree , 0 );
		$this->getImageResult( $img );

		return $this;
	}

	/**
	 * @return resource
	 */
	protected function getGdImage()
	{
		if ( $this->isFile() )
		{
			switch( $this->getExtension() )
			{
				case "png":
					return imagecreatefrompng( $this->file );
				case "gif":
					return imagecreatefromgif( $this->file );
				default:
					return imagecreatefromjpeg( $this->file );
			}
		}

		return false;
	}

	/**
	 * @param $imageResult
	 * @return string
	 */
	protected function getImageResult( $imageResult )
	{
		switch( $this->getExtension() )
		{
			case "png":
				imagepng( $imageResult , $this->file , $this->getQuality() / 10 );
				break;
			case "gif":
				imagegif( $imageResult , $this->file );
				break;
			default:
				imagejpeg( $imageResult , $this->file , $this->getQuality() );
		}

		imagedestroy( $imageResult );

		return $this;
	}

}