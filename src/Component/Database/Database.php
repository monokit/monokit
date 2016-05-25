<?php

namespace MonoKit\Component\Database;

use MonoKit\EntityManager\Entity;
use MonoKit\Component\Database\Interfaces\DatabaseInterface;

Class Database extends Entity implements DatabaseInterface
{
    /** @var string */
    protected $name;

    /**
     * @param string $name
     * @return Database
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}