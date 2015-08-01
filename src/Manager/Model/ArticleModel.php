<?php

namespace MonoKit\Manager\Model;

Abstract Class ArticleModel extends AbstractModel
{
    /** @var string */
    protected $header;
    /** @var string */
    protected $body;

    /**
     * @param string $value
     * @return ArticleModel
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
     * @return ArticleModel
     */
    public function setBody( $value )
    {
        $this->body = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

}

?>
