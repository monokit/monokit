<?php

namespace MonoKit\Model;

use MonoKit\EntityManager\Entity;

Abstract Class Link extends Entity
{
    /** @var string */
    protected $label;
    /** @var string */
    protected $description;
    /** @var string */
    protected $url;

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
     * @param string $url
     * @return Link
     */
    public function setUrl( $url )
    {
        $this->url = ( filter_var( $url , FILTER_VALIDATE_URL ) ) ? $url : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}