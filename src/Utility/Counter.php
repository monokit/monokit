<?php

namespace MonoKit\Utility;

use MonoKit\Manager\Entity;

Class Counter extends Entity
{
    /** @var int */
    protected $counter = 0;

    /**
     * @param int $value
     * @return Counter
     */
    public function setCounter( $value )
    {
        $this->counter= (int) $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getCounter()
    {
        return $this->counter;
    }

}

?>