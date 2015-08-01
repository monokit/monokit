<?php

namespace MonoKit\Manager\Model;

Abstract Class PersonContactModel extends PersonModel
{
    /** @var string */
    protected $mail;
    /** @var string */
    protected $phone;
    /** @var string */
    protected $mobile;
    /** @var string */
    protected $fax;

    /**
     * @param string $value
     * @return PersonContactModel
     */
    public function setMail( $value )
    {
        if ( filter_var( $value , FILTER_VALIDATE_EMAIL) )
            $this->mail = $value;

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
     * @param string $value
     * @return PersonContactModel
     */
    public function setPhone( $value )
    {
        $this->phone = $value;
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
     * @param string $value
     * @return PersonContactModel
     */
    public function setMobile( $value )
    {
        $this->mobile = $value;
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
     * @param string $value
     * @return PersonContactModel
     */
    public function setFax( $value )
    {
        $this->fax = $value;
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

?>
