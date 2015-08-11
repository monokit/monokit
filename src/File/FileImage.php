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
	/**
	 * @return bool|int
	 */
	public function getWidth()
	{
		if ( !$this->isFile() )
			return false;

		list( $width ) = getimagesize( $this->file );
		return $width;
	}

	/**
	 * @return bool|int
	 */
	public function getHeight()
	{
		if ( !$this->isFile() )
			return false;

		list(, $height ) = getimagesize( $this->file );
		return $height;
	}

	/**
	 * @return bool
	 */
	public function getType()
	{
		if ( !$this->isFile() )
			return false;

		list(,, $type ) = getimagesize( $this->file );
		return $type;
	}

	/**
	 * @return bool
	 */
	public function getAttribute()
	{
		if ( !$this->isFile() )
			return false;

		list(,,, $attr ) = getimagesize( $this->file );
		return $attr;
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
				imagepng( $imageResult , $this->file );
				break;
			case "gif":
				imagegif( $imageResult , $this->file );
				break;
			default:
				imagejpeg( $imageResult , $this->file );
		}

		imagedestroy( $imageResult );

		return $this;
	}


}

?>