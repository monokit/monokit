<?php 

namespace MonoKit\Component\DateString;

use MonoKit\EntityManager\Entity;

/**
 * Gestion d'une date
 *
 * @author Micka VAN HAREN
 * @version 03/2015
 */
 class DateString extends Entity
{
	/** @var /DateTime */
	protected $date;

	/**
	 * Constructeur de la classe Date
	 *
	 * @example $Date = new Date('2013-12-31'); // Défaut = date système.
	 * @param /DateTime $date
	 */
	public function __construct( $date = null )
	{
		date_default_timezone_set('Europe/Brussels');
		$this->setDate( $date );
	}

	/**
	 * Affection d'une date au format international.
	 *
	 * @example $Date->set('2013/12/31');
	 * @param date
	 * @return DateString
	 */
	public function setDate( $date = null )
	{
		$this->date = ( is_null( $date ) ) ? date("Y-m-d") : $date;
		return $this;
	}

	/**
	 * Returns the day of the week (0 for Sunday, 1 for Monday, and so on) specified by this Date according to local time.
	 *
	 * @example $Date->getDay();
	 * @return int
	 */
	public function getDay()
	{
		return date( "w" , strtotime( $this->date ) );
	}

	/**
	 * Returns the day of the month (an integer from 1 to 31) specified by a Date object according to local time.
	 *
	 * @example $Date->getDate();
	 * @return int
	 */
	public function getDate()
	{
		return date( "d" , strtotime( $this->date ) );
	}

	/**
	 * Returns the month (1 for January, 2 for February, and so on) portion of this Date according to local time.
	 *
	 * @example $Date->getMonth();
	 * @return int
	 */
	public function getMonth()
	{
		return date( "n" , strtotime( $this->date ) );
	}

	/**
	 * Returns the full year (a four-digit number, such as 2000) of a Date object according to local time.
	 *
	 * @example $Date->getYear(); // 2013
	 * @return int
	 */
	public function getYear()
	{
		return date( "Y" , strtotime( $this->date ) );
	}

	/**
	 * Retourne la date au format string. ('FR' par d�faut)
	 *
	 * @example $Date->toString('FR'); // jeudi 13 juin 2013
	 * @param string
	 * @return string
	 */
	public function toString( $iso = null )
	{
		switch( $iso ) {
	
			case "EN":
				$jour = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
				$mois = array('','january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december' );		
				break;
				
			case "NL":
				$jour = array('zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag');
				$mois = array('','januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'Oktober', 'november', 'december' );		
				break;
			
			case "FR":
			default:
				$jour = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
				$mois = array('','janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre' );

		}
		
		return $jour[ $this->getDay() ]." ".$this->getDate()." ".$mois[ $this->getMonth() ]." ".$this->getYear();
	
	}

	 /**
	  * @return mixed
	  */
     public function toDate()
     {
         return $this->date;
     }

}

?>