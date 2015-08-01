<?php

namespace MonoKit\Database;

use MonoKit\Manager\Entity;

class Access extends Entity
{
    /** @var string */
    protected $host;
    /** @var string */
    protected $login;
    /** @var string */
    protected $passwd;
    /** @var string */
    protected $dbname;
    /** @var string */
    protected $charset = "UTF8";

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return DatabaseAccess
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return DatabaseAccess
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * @param string $passwd
     * @return DatabaseAccess
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
        return $this;
    }

    /**
     * @return string
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * @param string $dbname
     * @return DatabaseAccess
     */
    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param string $charset
     * @return DatabaseAccess
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

}