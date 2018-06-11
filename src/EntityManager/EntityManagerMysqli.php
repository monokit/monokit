<?php

namespace MonoKit\EntityManager;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Database\Sql\Exception\SqlException;
use MonoKit\Component\Database\Sql\Interfaces\SqlInterface;
use MonoKit\Component\Service\MysqliService;
use MonoKit\EntityManager\Exception\EntityManagerMysqliException;
use MonoKit\EntityManager\Interfaces\EntityInterface;

Class EntityManagerMysqli extends EntityManager
{
    /** @var MysqliService */
    private $MySqliService;

    /**
     * EntityManagerMysqli constructor.
     * @param MysqliService|null $mysqliService
     * @throws EntityManagerMysqliException
     */
    public function __construct( MysqliService $mysqliService = null )
    {
        if ( is_null( $mysqliService) )
            $mysqliService = AppRegistry::AppRegistry( AppRegistry::APPLICATION_SERVICE . __DOT__ . MysqliService::BASENAME );

        if ( !$mysqliService )
            throw new EntityManagerMysqliException(EntityManagerMysqliException::SERVICE_NOTFOUND , $this );

        $this->setMysliService( $mysqliService );
    }

    /**
     * @param MysqliService $mysqliService
     * @return EntityManagerMysqli
     */
    protected function setMysliService( MysqliService $mysqliService )
    {
        $this->MySqliService = $mysqliService;
        return $this;
    }

    /**
     * @return MysqliService
     */
    protected function getMysqliService()
    {
        return $this->MySqliService;
    }

    /**
     * @param SqlInterface $sql
     * @param EntityInterface|null $entity
     * @return EntityManagerMysqli
     * @throws SqlException
     */
    protected function query( SqlInterface $sql , EntityInterface $entity = null )
    {
        $this->removeAll();

        if ( !$result = $this->getMysqliService()->query( $sql->toString() ) )
            throw new SqlException( SqlException::ERROR_SQL , $this , $sql->toString() );

        return ( $entity ) ? $this->fetch( $result , $entity ) : $this;
    }

    /**
     * @param \mysqli_result $result
     * @param EntityInterface|null $entity
     * @return EntityManagerMysqli
     */
    protected function fetch( \mysqli_result $result , EntityInterface $entity = null )
    {
        while( $data = $result->fetch_assoc() )
            $this->add( $entity->getClone()->map( $data ) );

        return $this;
    }
}