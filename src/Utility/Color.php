<?php

namespace MonoKit\Utility;

use MonoKit\Manager\Entity;

/**
 * La classe MonoKit\Utils\Color gère une couleur hexadécimale.
 *
 * @author Micka VAN HAREN
 * @version 03/2015
 **/
class Color extends Entity
{
	/** @var string */
	protected $color;
	
	/**
	 * Constructeur de la classe Color
	 *
	 * @example $Color = new Color( '#FFFFFF' );.
	 * @param string
	 */
	public function __construct( $color = null )
	{
		$this->set( $color );
	}

	/**
	 * Affection d'une couleur au format hexadécimal.
	 *
	 * @example $Color->set( '#FFFFFF' );;
	 * @param string
	 * @return Color
	 */
	public function set( $color = null )
	{
		$this->color = ( is_null( $color ) ) ? '#000000' : $color;
		return $this;
	}

	/**
	 * Retourne la couleur au format hexadécimal.
	 *
	 * @example $Color->get(); // #FFFFFF
	 * @return string
	 */
	public function get()
	{
		return $this->color;
	}

	/**
	 * Retourne la couleur au format RGB.
	 *
	 * @example $Color->getRGB(); // #FFFFFF
	 * @return string
	 */
	public function getRGB()
	{
		$c = str_replace( "#" , "" , $this->color );

		if( strlen( $c ) == 3 )
		{
		  $r = hexdec(substr($c,0,1).substr($c,0,1));
		  $g = hexdec(substr($c,1,1).substr($c,1,1));
		  $b = hexdec(substr($c,2,1).substr($c,2,1));
		} else {
		  $r = hexdec(substr($c,0,2));
		  $g = hexdec(substr($c,2,2));
		  $b = hexdec(substr($c,4,2));
		}

		return new ColorRGB( $r , $g , $b);
	}

	
}

/**
 * La Classe ColorRGB gère une couleur RGB
 *
 * @author Micka VAN HAREN
 * @version 03/2015
 **/
class ColorRGB
{
	public $red;
	public $green;
	public $blue;

	public function __construct( $red = 0 , $green = 0 , $blue = 0 )
	{
		$this->red 		= $red;
		$this->green 	= $green;
		$this->blue 	= $blue;
	}

}

?>