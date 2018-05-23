<?php

namespace MonoKit\Model;

use MonoKit\EntityManager\Entity;

Class Link extends Entity
{
    /** @var string */
    protected $label;
    /** @var string */
    protected $description;
    /** @var Url */
    protected $Url;

    /**
     * @param string $label
     * @return Link
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $description
     * @return Link
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Url $url
     * @return Link
     */
    public function setUrl( Url $url )
    {
        $this->Url = $url;
        return $this;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->Url;
    }
}