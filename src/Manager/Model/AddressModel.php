<?php

namespace MonoKit\Manager\Model;

Abstract Class AddressModel extends AbstractModel
{
    /** @var string */
    protected $street;
    /** @var string */
    protected $streetNumber;
    /** @var string */
    protected $zip;
    /** @var string */
    protected $city;

    /**
     * @param string $value
     * @return AddressModel
     */
    public function setStreet( $value )
    {
        $this->street = $value;
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
     * @param string $value
     * @return AddressModel
     */
    public function setStreetNumber( $value )
    {
        $this->streetNumber = $value;
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
     * @param string $value
     * @return AddressModel
     */
    public function setZip( $value )
    {
        $this->zip = $value;
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
     * @param string $value
     * @return AddressModel
     */
    public function setCity( $value )
    {
        $this->city = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

}

?>
