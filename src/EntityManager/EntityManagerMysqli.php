<?php

namespace MonoKit\EntityManager;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Database\Sql\Exception\SqlException;
use MonoKit\Component\Database\Sql\Interfaces\SqlInterface;
use MonoKit\Component\Service\MysqliService;
use MonoKit\EntityManager\Exception\EntityManagerMysqliException;

Class EntityManagerMysqli extends EntityManager
{
    /** @var boolean */
    protected $status = true;
    /** @var string */
    protected $message;
    /** @var MysqliService */
    private $MySqliService;
    /** @var string */
    private $sql;

    /**
     * EntityManagerMysqli constructor.
     * @param MysqliService|null $mysqliService
     */
    public function __construct( MysqliService $mysqliService = null )
    {
        $this->setMysliService( $mysqliService );
    }

    /**
     * @param boolean $status
     * @return EntityManagerMysqli
     */
    public function setStatus( $status )
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param string $message
     * @return EntityManagerMysqli
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

    /**
     * @param MysqliService $mysqliService
     * @return EntityManagerMysqli
     */
    protected function setMysliService( MysqliService $mysqliService = null )
    {
        $this->MySqliService = ( is_null( $mysqliService ) ) ? AppRegistry::AppRegistry( AppRegistry::APPLICATION_SERVICE . __DOT__ . MysqliService::BASENAME ) : $mysqliService ;
        return $this;
    }

    /**
     * @return MysqliService
     * @throws EntityManagerMysqliException
     */
    protected function getMysqliService()
    {
        if ( !$this->MySqliService )
            throw new EntityManagerMysqliException(EntityManagerMysqliException::SERVICE_NOTFOUND , $this );

        return $this->MySqliService;
    }

    /**
     * @param SqlInterface $sql
     * @param Entity|null $entity
     * @return EntityManagerMysqli
     * @throws EntityManagerMysqliException
     * @throws SqlException
     */
    protected function query( SqlInterface $sql , Entity $entity = null )
    {
        $this->removeAll();

        $this->setSql( $sql );

        if ( !$result = $this->getMysqliService()->query( $this->getSql() ) )
            throw new SqlException( SqlException::ERROR_SQL , $this , $this->getSql() );

        if ( $entity )
            return $this->fetch( $result , $entity );

        return $this;
    }

    /**
     * @param Entity $entity
     * @return EntityManagerMysqli
     */
    protected function fetch( \mysqli_result $result , Entity $entity = null )
    {
        while( $data = $result->fetch_assoc() )
            $this->add( $entity->getClone()->serialize( $data ) );

        return $this;
    }

    /**
     * @param SqlInterface $sql
     * @return EntityManagerMysqli
     */
    protected function setSql( SqlInterface $sql )
    {
        $this->sql = $sql->toString();

        AppRegistry::AppRegistry( AppRegistry::APPLICATION_DATABASE_SQL . __DOT__ . $this->getUniqueId() , $this->sql );

        return $this;
    }

    /**
     * @return SqlInterface
     */
    protected function getSql()
    {
        return $this->sql;
    }
}