<?php

namespace MonoKit\Manager\Model;

use MonoKit\Utility\Date;

Abstract Class EventModel extends AbstractModel
{
    /** @var string */
    protected $header;
    /** @var string */
    protected $description;
    /** @var Date */
    protected $Date;

    /**
     * @param string $value
     * @return EventModel
     */
    public function setHeader( $value )
    {
        $this->header = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param string $value
     * @return EventModel
     */
    public function setDescription( $value )
    {
        $this->description = $value;
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
     * @param $value
     * @return EventModel
     */
    public function setDate( Date $value )
    {
        $this->Date = $value;
        return $this;
    }

    /**
     * @return Date
     */
    public function getDate()
    {
        if ( !$this->Date )
            $this->Date = new Date();

        return $this->Date;
    }

}

?>
