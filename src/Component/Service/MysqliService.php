<?php

namespace MonoKit\Component\Service;

use MonoKit\Component\Service\Interfaces\ServiceInterface;

Class MysqliService extends \mysqli implements ServiceInterface
{
    const BASENAME = "MYSQLI";

    /** @var string */
    protected $name = self::BASENAME;

    /**
     * MysqliService constructor.
     * @param string $host
     * @param string $username
     * @param string $passwd
     * @param string $dbname
     * @param int $port
     * @param string $socket
     */
    public function __construct( $host, $username, $passwd, $dbname, $port = null , $socket = null )
    {
        parent::__construct( $host, $username, $passwd, $dbname, $port, $socket);

        $this->set_charset( "UTF8" );
    }

    /**
     * @param string $name
     * @return $this
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

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->ping();
    }


}