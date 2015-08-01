<?php

namespace MonoKit\Manager\Model;

Abstract Class CompanyModel extends AbstractModel
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $tvaNumber;

    /**
     * @param string $value
     * @return CompanyModel
     */
    public function setName( $value )
    {
        $this->name = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $value
     * @return CompanyModel
     */
    public function setTvaNumber( $value )
    {
        $this->tvaNumber = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getTvaNumber()
    {
        return $this->tvaNumber;
    }

}

?>
