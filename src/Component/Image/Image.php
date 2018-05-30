<?php

namespace MonoKit\Component\Image;

use MonoKit\EntityManager\Entity;

Class Image extends Entity
{
    const SRC = "src";
    const SRC_SIZE = 1024;

    const THUMB = "thumb";
    const THUMB_SIZE = 128;

    const SQUARE = "square";
    const SQUARE_SIZE = 256;

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
     * @param string $imagePath
     * @param bool $microtimeEnabled
     * @return Image
     */
    public function setSrc( $imagePath , $microtimeEnabled = false )
    {
        $this->src = $imagePath . __DS__ . self::SRC;

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
     * @param string $imagePath
     * @param bool $microtimeEnabled
     * @return Image
     */
    public function setThumb( $imagePath , $microtimeEnabled = false )
    {
        $this->thumb = $imagePath . __DS__ . self::THUMB;

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
     * @param string $imagePath
     * @param bool $microtimeEnabled
     * @return Image
     */
    public function setSquare( $imagePath , $microtimeEnabled = false )
    {
        $this->square = $imagePath . __DS__ . self::SQUARE;

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