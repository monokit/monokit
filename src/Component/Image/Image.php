<?php

namespace MonoKit\Component\Image;

use MonoKit\EntityManager\Entity;

Class Image extends Entity
{
    const SRC = "src";
    const MAX_SIZE = 960;

    const THUMB = "thumb";
    const THUMB_SIZE = 150;

    const SQUARE = "square";
    const SQUARE_SIZE = 450;

    /** @var string */
    protected $src;
    /** @var string */
    protected $thumb;
    /** @var string */
    protected $square;
    /** @var string */
    protected $caption;

    /**
     * Image constructor.
     * @param string $src
     * @param bool $microtimeEnabled
     */
    public function __construct( $src = null , $microtimeEnabled = false )
    {
        $this->setSrc( $src , $microtimeEnabled );
        $this->setThumb( $src , $microtimeEnabled );
        $this->setSquare( $src , $microtimeEnabled );
    }

    /**
     * @param string $src
     * @param bool $microtimeEnabled
     * @return Image
     */
    public function setSrc( $src , $microtimeEnabled = false )
    {
        $this->src = $src . "/src";

        if ( $microtimeEnabled )
            $this->src .= "?{$this->getMicrotime()}";

        return $this;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param string $thumb
     * @param bool $microtimeEnabled
     * @return Image
     */
    public function setThumb( $thumb , $microtimeEnabled = false )
    {
        $this->thumb = $thumb . "/thumb";

        if ( $microtimeEnabled )
            $this->thumb .= "?{$this->getMicrotime()}";

        return $this;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param string $square
     * @param bool $microtimeEnabled
     * @return Image
     */
    public function setSquare( $square , $microtimeEnabled = false )
    {
        $this->square = $square . "/square";

        if ( $microtimeEnabled )
            $this->square .= "?{$this->getMicrotime()}";

        return $this;
    }

    /**
     * @return string
     */
    public function getSquare()
    {
        return $this->square;
    }

    /**
     * @param string $caption
     * @return Image
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return mixed
     */
    protected function getMicrotime()
    {
        return microtime( true ) * 10000;
    }
}