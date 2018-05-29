<?php

namespace MonoKit\Model;

use MonoKit\EntityManager\Entity;

Class Address extends Entity
{
    /** @var string */
    protected $street;
    /** @var string */
    protected $streetNumber;
    /** @var string */
    protected $zip;
    /** @var string */
    protected $city;
    /** @var string */
    protected $region;
    /** @var Country */
    protected $Country;

    /**
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $streetNumber
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $zip
     * @return Address
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $region
     * @return Address
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param Country $Country
     * @return Address
     */
    public function setCountry( Country $Country)
    {
        $this->Country = $Country;
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->Country;
    }
}