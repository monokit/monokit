<?php

namespace MonoKit\Component\Notify;

use MonoKit\EntityManager\Entity;

Class Notify extends Entity implements NotifyInterface
{
    const TYPE_MESSAGE  = "MESSAGE";
    const TYPE_ALERT    = "ALERT";
    const TYPE_WARNING  = "WARNING";
    const TYPE_SUCCESS  = "SUCCESS";

    /** @var string */
    protected $type;
    /** @var string */
    protected $title;
    /** @var string */
    protected $message;

    /**
     * Notify constructor.
     * @param $title
     * @param null $message
     * @param string $type
     */
    public function __construct( $title , $message = null , $type = self::TYPE_MESSAGE )
    {
        $this->setTitle( $title );
        $this->setMessage( $message );
        $this->setType( $type );
    }

    /**
     * @param string $type
     * @return Notify
     */
    public function setType( $type = self::TYPE_MESSAGE )
    {
        switch ( $type )
        {
            case self::TYPE_ALERT:
            case self::TYPE_WARNING:
            case self::TYPE_SUCCESS:
                $this->type = $type;
                break;

            default:
                $this->type = self::TYPE_MESSAGE;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $title
     * @return Notify
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $message
     * @return Notify
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}