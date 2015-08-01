<?php

namespace MonoKit\File;
use MonoKit\Utility\Dimension;

/**
 * Cette classe gère une image sélectionnée sur le serveur.
 *
 * @author Micka VAN HAREN
 * @version 02/2015
 */
Class FileImage extends File
{
	/**
	 * Retourne la largeur de l'image
	 *
	 * @example $Image->getWidth();
	 * @return int
	 */
	public function getWidth()
	{
		if ( !$this->isFile() )
			return null;

		list( $width ) = getimagesize( $this->file );
		return $width;
	}

	/**
	 * Retourne la hauteur de l'image
	 *
	 * @example $Image->getHeight();
	 * @return int
	 */
	public function getHeight()
	{
		if ( !$this->isFile() )
			return null;

		list(, $height ) = getimagesize( $this->file );
		return $height;
	}

	/**
	 * @return string|null
	 */
	public function getType()
	{
		if ( !$this->isFile() )
			return null;

		list(,, $type ) = getimagesize( $this->file );
		return $type;
	}

	/**
	 * @return string|null
	 */
	public function getAttribute()
	{
		if ( !$this->isFile() )
			return null;

		list(,,, $attr ) = getimagesize( $this->file );
		return $attr;
	}

    /**
     * Retoure le ratio de l'image
     *
     * @return float
     */
    public function getRatio()
    {
		if ( !$this->isFile() )
			return null;

        return $this->getHeight() / $this->getWidth();
    }

    /**
     * @return Dimension
     */
	public function getDimension()
    {
        return new Dimension( $this->getWidth() , $this->getHeight() );
    }

    public function getAuthor()
    {

    }


}

?>