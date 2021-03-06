<?php

namespace MonoKit\Model;

use MonoKit\EntityManager\Entity;

Class Person extends Entity
{
    /** @var string */
    protected $lastName;
    /** @var string */
    protected $firstName;
    /** @var \DateTime */
    protected $birthDate;
    /** @var string */
    protected $gender = "M";

    /**
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = strtoupper( $lastName );
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
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = ucfirst( $firstName );
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
        return $this->getLastName() . __SPACE__ . $this->getFirstName();
    }

    /**
     * @param \DateTime|string $date
     * @return Person
     */
    public function setBirthDate( $date )
    {
        $this->birthDate = ( is_a( $date , "DateTime" ) ) ? $date : new \DateTime( $date );
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param string $gender
     * @return Person
     */
    public function setGender($gender)
    {
        $this->gender = ($gender == "F" ) ? "F" : "M";
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return bool
     */
    public function isGenderMale()
    {
        return ( $this->getGender() == "M" );
    }

    /**
     * @return bool
     */
    public function isGenderFemale()
    {
        return !$this->isGenderMale();
    }

}