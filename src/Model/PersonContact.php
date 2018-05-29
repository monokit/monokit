<?php

namespace MonoKit\Model;

Class PersonContact extends Person
{
    /** @var Address */
    protected $Address;
    /** @var Coordinate */
    protected $Coordinate;

    /**
     * @param Address $Address
     * @return PersonContact
     */
    public function setAddress( Address $Address )
    {
        $this->Address = $Address;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param Coordinate $Coordinate
     * @return PersonContact
     */
    public function setCoordinate( Coordinate $Coordinate )
    {
        $this->Coordinate = $Coordinate;
        return $this;
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate()
    {
        return $this->Coordinate;
    }
}