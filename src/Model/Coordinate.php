<?php

namespace MonoKit\Model;

use MonoKit\EntityManager\Entity;

Class Coordinate extends Entity
{
    const FIELDS = "Coordinate_mail AS 'Coordinate.mail', Coordinate_mobile AS 'Coordinate.mobile', Coordinate_phone AS 'Coordinate.phone', Coordinate_fax AS 'Coordinate.fax'";

    /** @var string */
    protected $mail;
    /** @var string */
    protected $mobile;
    /** @var string */
    protected $phone;
    /** @var string */
    protected $fax;

    /**
     * @param string $mail
     * @return Coordinate
     */
    public function setMail( $mail )
    {
        $this->mail = ( filter_var($mail, FILTER_VALIDATE_EMAIL) ) ? $mail : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mobile
     * @return Coordinate
     */
    public function setMobile( $mobile )
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $phone
     * @return Coordinate
     */
    public function setPhone( $phone )
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $fax
     * @return Coordinate
     */
    public function setFax( $fax )
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }
}