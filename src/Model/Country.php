<?php

namespace MonoKit\Model;

use MonoKit\EntityManager\Entity;

Class Country extends Entity
{
    /** @var string */
    protected $isoCode;
    /** @var string */
    protected $label;

    /**
     * @param string $isoCode
     * @return Country
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * @param string $label
     * @return Country
     */
    public function setLabel($label)
    {
        $this->label = ucfirst( $label );
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

}