<?php
namespace MonoKit\Manager;

use MonoKit\Database\Sql\SqlInterface;
use MonoKit\Database\Sql\SqlException;
use MonoKit\Foundation\FoundationException;

/**
 * Support de classe [xxxxManager]
 *
 * @author Micka VAN HAREN
 * @version 07/2015
 */
Abstract Class EntityManagerMysqli extends EntityManager
{
    /** @var SqlInterface */
	private $sql;
	/** @var \Mysqli */
    private $mysqli;
	/** @var \mysqli_result */
    private $mysqli_result;

    /**
     * @param \Mysqli|null $mysqli
     * @throws FoundationException
     */
	public function __construct( \Mysqli $mysqli = null )
	{
		$this->mysqli = ( !is_null( $mysqli ) ) ? $mysqli : $this->AppService( "MYSQLI" );

        if ( !$this->mysqli )
            throw new FoundationException( "Aucune connexion Mysqli trouvée..." , $this );

        $this->mysqli->set_charset( "UTF8" );

        parent::__construct();
	}

    /**
     * @param SqlInterface $sql
     * @return EntityManagerMysqli
     */
    protected function setSql( SqlInterface $sql )
    {
        $this->sql = $sql;
        return $this;
    }

    /**
     * @return SqlInterface
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
        $this->setSql( $sql );

		if ( !$this->mysqli_result = $this->mysqli->query( $this->getSql()->toString() ) )
			throw new SqlException( SqlException::ERROR_SQL , $this , $this->getSql()->toString() );

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
