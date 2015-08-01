<?php

namespace MonoKit\Manager\Model;

use MonoKit\Manager\Entity;

Abstract Class AbstractModel extends Entity
{
    /** @var int */
    protected $id;

    /**
     * @param int $id
     * @return AbstractModel
     */
    public function setId( $id )
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}