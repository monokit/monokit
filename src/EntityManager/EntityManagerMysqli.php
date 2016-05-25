<?php

namespace MonoKit\EntityManager;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Database\Sql\Exception\SqlException;
use MonoKit\Component\Database\Sql\Interfaces\SqlInterface;
use MonoKit\Component\Service\MysqliService;
use MonoKit\EntityManager\Exception\EntityManagerMysqliException;

Class EntityManagerMysqli extends EntityManager
{
    /** @var MysqliService */
    private $MySqliService;
    /** @var SqlInterface */
    private $sql;

    public function __construct( MysqliService $mysqliService = null )
    {
        $this->setMysliService( $mysqliService );
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
     * @return $this|EntityManagerMysqli
     * @throws EntityManagerMysqliException
     * @throws SqlException
     */
    protected function query( SqlInterface $sql , Entity $entity = null )
    {
        $this->removeAll();

        $this->setSql( $sql );

        if ( !$result = $this->getMysqliService()->query( $sql ) )
            throw new SqlException( SqlException::ERROR_SQL , $this , $sql );

        if ( $entity )
            return $this->fetch( $result , $entity );

        return $this;
    }

    /**
     * @param Entity $entity
     * @return $this
     */
    protected function fetch( \mysqli_result $result , Entity $entity = null )
    {
        while( $data = $result->fetch_assoc() )
            $this->add( $entity->getClone()->serialize( $data ) );

        return $this;
    }

    /**
     * @param SqlInterface $sql
     * @return $this
     */
    protected function setSql( SqlInterface $sql )
    {
        $this->sql = $sql;

        AppRegistry::AppRegistry( AppRegistry::APPLICATION_DATABASE_SQL , $sql->toString() );

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