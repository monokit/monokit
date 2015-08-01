<?php

namespace MonoKit\Manager\Model;

Abstract Class PersonModel extends AbstractModel
{
	/** @var string */
	protected $gender;
	/** @var string */
	protected $lastName;
    /** @var string */
    protected $firstName;

    /**
     * @param string $value
     * @return PersonModel
     */
	public function setGender( $value )
	{
		$this->gender = $value;
		return $this;
	}

    /**
     * @return string
     */
	public function getGender()
	{
		return ( $this->gender == "FEMALE" ) ? "FEMALE" : "MALE";
	}

    /**
     * @param string $value
     * @return PersonModel
     */
	public function setLastName( $value )
	{
		$this->lastName = strtoupper( $value );
		return $this;
	}

    /**
     * @return string
     */
	public function getLastName()
	{
		return $this->lastName;
	}

    /**
     * @param string $value
     * @return PersonModel
     */
    public function setFirstName( $value )
    {
        $this->firstName = ucwords( $value );
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getLastName().' '.$this->getFirstName();
    }

}

?>
