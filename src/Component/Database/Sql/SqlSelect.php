<?php

namespace MonoKit\Component\Database\Sql;

use MonoKit\Component\Database\Sql\Entity\SqlTable;
use MonoKit\Component\Database\Sql\Entity\SqlLeftJoinTable;
use MonoKit\Component\Database\Sql\Entity\SqlRightJoinTable;
use MonoKit\Component\Database\Sql\Entity\SqlInnerJoinTable;
use MonoKit\Component\Database\Sql\Manager\SqlTableManager;

class SqlSelect extends Sql
{
    /** @var SqlTableManager */
    protected $JoinTableManager;

    /**
     * @param string $tableName
     * @param string|null $tableAlias
     */
    public function __construct( $tableName , $tableAlias = null )
    {
        parent::__construct();

        $this->setSqlTable( new SqlTable( $tableName , $tableAlias ) );
        $this->setJoinTableManager( new SqlTableManager() );
    }

    /**
     * @param SqlTableManager $tableManager
     * @return SqlUpdate
     */
    protected function setJoinTableManager( SqlTableManager $tableManager )
    {
        $this->JoinTableManager = $tableManager;
        return $this;
    }

    /**
     * @return SqlTableManager
     */
    protected function getJoinTableManager()
    {
        return $this->JoinTableManager;
    }

    /**
     * @param string $columns
     * @return SqlSelect
     */
    public function setColumns( $columns )
    {
        $this->getSqlTable()->setColumns( explode( "," , $columns )) ;
        return $this;
    }

    /**
     * @param string $tableName
     * @param string $columns
     * @param string $condition
     * @return SqlSelect
     */
    public function setInnerJoin( $tableName , $columns , $condition)
    {
        $tableName = explode( " AS " , $tableName );

        $Table = new SqlInnerJoinTable( $tableName[0] , end($tableName) );
        $Table->setColumns( explode( "," , $columns ));
        $Table->setCondition($condition);

        $this->getJoinTableManager()->add( $Table );

        return $this;
    }

    /**
     * @param string $tableName
     * @param string $columns
     * @param string $condition
     * @return SqlSelect
     */
    public function setLeftJoin( $tableName , $columns , $condition )
    {
        $tableName = explode( " AS " , $tableName );

        $LeftJoinTable = new SqlLeftJoinTable( $tableName[0] , end($tableName) );
        $LeftJoinTable->setColumns( explode( "," , $columns ) );
        $LeftJoinTable->setCondition( $condition );

        $this->getJoinTableManager()->add( $LeftJoinTable );

        return $this;
    }

    /**
     * @param string $tableName
     * @param string $columns
     * @param string $condition
     * @return SqlSelect
     */
    public function setRightJoin( $tableName , $columns , $condition )
    {
        $tableName = explode( " AS " , $tableName );

        $Table = new SqlRightJoinTable( $tableName[0] , end($tableName) );
        $Table->setColumns( explode( "," , $columns ) );
        $Table->setCondition( $condition );

        $this->getJoinTableManager()->add( $Table );

        return $this;
    }

    /**
     * @param string $condition
     * @param bool|true $autoAlias
     * @return SqlSelect
     */
    public function where( $condition , $autoAlias = true )
    {
        if ( $autoAlias )
        {
            $this->getSqlTable()->setCondition( $this->getSqlTable()->getAlias() . __DOT__ . $condition );
        } else {
            $this->getSqlTable()->setCondition( $condition );
        }

        return $this;
    }

    /**
     * @param string $order
     * @param bool|true $autoAlias
     * @return SqlSelect
     */
    public function order( $order , $autoAlias = true )
    {
        if ( $autoAlias )
        {
            $this->getSqlTable()->setOrder( $this->getSqlTable()->getAlias() . __DOT__ . $order );
        } else {
            $this->getSqlTable()->setOrder( $order );
        }

        return $this;
    }

    /**
     * @param string $order
     * @param string $type
     * @param bool|true $autoAlias
     * @return SqlSelect
     */
    public function orderBy( $order , $type = "ASC" , $autoAlias = true )
    {
        $this->getSqlTable()->setOrderType( $type );

        return $this->order( $order , $autoAlias );
    }

    /**
     * @return string
     */
    public function toString()
    {
        $columnArray = array();
        $joinTableArray = array();

        $columnArray[] = $this->getSqlTable()->getColumnManager()->toString();

        foreach ( $this->getJoinTableManager() as $joinTable )
        {
            $joinTableArray[] = $joinTable->toString();
            $columnArray[] = $joinTable->getColumnManager()->toString();
        }

        $columnsString = implode( ", " , $columnArray );
        $columnsString = ( substr($columnsString, 0 , 1 ) == "*" ) ? $this->getSqlTable()->getAlias() . __DOT__ . $columnsString : $columnsString;

        return sprintf("SELECT %s FROM %s %s %s %s",    $columnsString,
                                                        $this->getSqlTable()->toString(),
                                                        implode(__SPACE__, $joinTableArray),
                                                        $this->getSqlTable()->getCondition(),
                                                        $this->getSqlTable()->getOrder());

    }
}
