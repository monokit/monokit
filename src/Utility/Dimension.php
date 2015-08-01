<?php

namespace MonoKit\Utility;

use MonoKit\Manager\Entity;

/**
 * La Classe Dimension gère une dimension 2D
 *
 * @author Micka VAN HAREN
 * @version 06/2014
 **/
class Dimension extends Entity
{
	/** @var int */
	protected $width;
	/** @var int */
	protected $height;

	public function __construct( $width = 0 , $height = 0 )
	{
		$this->set( $width , $height );
	}

	/**
	 * Spécifie la largeur & la hauteur.
	 *
	 * @example $Dimension->set( 90 , 150 );
     * @param int $width
     * @param int $height
     * @return Dimension
     **/
	public function set( $width , $height )
	{
		$this->setWidth( $width );
		$this->setHeight( $height );
		return $this;
	}

	/**
	 * Spécifie la largeur.
	 *
	 * @example $Dimension->setWidth( 728 );
     * @param int $width
     * @return Dimension
     **/
	public function setWidth( $width )
	{
		$this->width = (int) $width;
		return $this;
	}

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

	/**
	 * Spécifie la hauteur.
	 *
	 * @example $Dimension->setHeight( 90 );
     * @param int $height
     * @return Dimension
     **/
	public function setHeight( $height )
	{
		$this->height = (int) $height;
		return $this;
	}

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

	/**
	 * Retourne le ratio.
	 *
	 * @example $Dimension->getRatio();
     * @return float
     **/
	public function getRatio()
	{
		if ( !$this->width || !$this->height )
			return 0;

		return $this->height / $this->width;
	}

}
?>