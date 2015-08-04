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
     * @return string
     */
    protected function getSql()
    {
        return $this->sql;
    }

    /**
     * @param SqlInterface $sql
     * @return EntityManagerMysqli
     * @throws SqlException
     */
	protected function query( SqlInterface $sql )
	{
        $this->sql = $sql->toString();

		if ( !$this->mysqli_result = $this->mysqli->query( $this->sql ) )
			throw new SqlException( SqlException::ERROR_SQL , $this , $this->sql );

		return $this;
	}

    /**
     * @param string $entityClass
     * @return EntityManagerMysqli
     */
    protected function fetchAll( $entityClass )
    {
        $this->removeAll();

        if ( $this->mysqli->affected_rows === 0 )
            return $this;

        while( $data = $this->mysqli_result->fetch_assoc() )
            $this->add( new $entityClass() , $data );

        return $this;
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
