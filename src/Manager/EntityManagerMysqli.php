<?php
namespace MonoKit\Manager;

use MonoKit\Database\Sql\SqlInterface;
use MonoKit\Database\Sql\SqlException;
use MonoKit\Database\DatabaseException;

/**
 * Support de classe [xxxxManager]
 *
 * @author Micka VAN HAREN
 * @version 07/2015
 */
Abstract Class EntityManagerMysqli extends EntityManager
{
    /** @var string */
	private $sql;
	/** @var \Mysqli */
    private $mysqli;
	/** @var \mysqli_result */
    private $mysqli_result;

    /**
     * @param \Mysqli|null $mysqli
     * @throws DatabaseException
     */
	public function __construct( \Mysqli $mysqli = null )
	{
		$this->mysqli = ( !is_null( $mysqli ) ) ? $mysqli : $this->AppService( "MYSQLI" );

        if ( !$this->mysqli )
            throw new DatabaseException( DatabaseException::ERROR_ACCESS_MYSQLI , $this );

        $this->mysqli->set_charset( "UTF8" );

        parent::__construct();
	}

    /**
     * @param SqlInterface $sql
     * @param EntityInterface|null $entity
     * @return $this|EntityManagerMysqli
     * @throws SqlException
     */
	protected function query( SqlInterface $sql , EntityInterface $entity = null )
	{
        $this->sql = $sql->toString();

		if ( !$this->mysqli_result = $this->mysqli->query( $this->sql ) )
			throw new SqlException( SqlException::ERROR_SQL , $this , $this->sql );

		return ( $entity ) ? $this->fetch( $entity ) : $this;
	}

    /**
     * @param EntityInterface $entity
     * @return $this
     */
    protected function fetch( EntityInterface $entity )
    {
        $this->removeAll();

        if ( $this->mysqli->affected_rows === 0 )
            return $this;

        while( $data = $this->mysqli_result->fetch_assoc() )
        {
            $e = clone $entity;
            $this->add( $e->setProperties( $data ) );
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getSql()
    {
        return $this->sql;
    }

	/**
	* @return int
	**/
	protected function getInsertId()
	{
		return $this->mysqli->insert_id;
	}


}

?>
