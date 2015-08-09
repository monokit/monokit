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

}

?>