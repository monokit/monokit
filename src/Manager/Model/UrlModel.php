<?php

namespace MonoKit\Manager\Model;

Abstract Class UrlModel extends AbstractModel
{
    /** @var string */
    protected $url;

    public function __construct( $url )
    {
        $this->setUrl( $url );
    }

    /**
     * @param string $value
     * @return UrlModel
     */
    public function setUrl( $value )
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getShortUrl()
    {
        return basename( $this->url );
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return filter_var( $this->url , FILTER_VALIDATE_URL );
    }

}

?>
