<?php

namespace MonoKit\Manager\Model;

Abstract Class LinkModel extends UrlModel
{
    /** @var string */
    protected $label;
    /** @var string */
    protected $target;

    /**
     * @param string $value
     * @return LinkModel
     */
    public function setLabel( $value )
    {
        $this->label = $value;
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
     * @param string $value
     * @return LinkModel
     */
    public function setTarget( $value )
    {
        $this->target = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

}

?>
