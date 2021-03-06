<?php

namespace MonoKit\Component\Database\Sql\Entity;

use MonoKit\Component\Database\Entity\Table;
use MonoKit\Component\Database\Sql\Manager\SqlColumnManager;

class SqlTable extends Table
{
    /** @var string */
    protected $alias;
    /** @var string */
    protected $condition;
    /** @var string */
    protected $order;
    /** @var string */
    protected $orderType = "ASC";
    /** @var string */
    protected $group;
    /** @var SqlColumnManager */
    protected $ColumnManager;

    /**
     * @param string $name
     * @param string|null $alias
     */
    public function __construct( $name , $alias = null )
    {
        parent::__construct( $name );
        $this->setAlias( $alias );
    }

    /**
     * @param string $alias
     * @return SqlTable
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        if ( !$this->alias )
            return $this->getName();

        return $this->alias;
    }

    /**
     * @param SqlColumnManager $columnManager
     * @return Table
     */
    public function setColumnManager( SqlColumnManager $columnManager )
    {
        $this->ColumnManager = $columnManager;
        return $this;
    }

    /**
     * @return SqlColumnManager
     */
    public function getColumnManager()
    {
        if ( !$this->ColumnManager )
            $this->ColumnManager = new SqlColumnManager();

        return $this->ColumnManager;
    }

    /**
     * @param string $condition
     * @return SqlTable
     */
    public function setCondition( $condition )
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCondition()
    {
        if ( $this->condition )
            return " WHERE ".$this->condition;

        return null;
    }

    /**
     * @param string $order
     * @return SqlTable
     */
    public function setOrder( $order )
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrder()
    {
        if ( $this->order )
            return "ORDER BY {$this->order} {$this->orderType}";

        return null;
    }

    /**
     * @param string $orderType
     * @return SqlTable
     */
    public function setOrderType( $orderType = "ASC" )
    {
        $this->orderType = ( $orderType == "DESC" ) ? "DESC" : "ASC";
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param string $group
     * @return SqlTable
     */
    public function setGroup( $group )
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroup()
    {
        if ( $this->group )
            return "GROUP BY {$this->group}";

        return null;
    }

    /**
     * @param string $columnName
     * @param null $value
     * @param bool $autoAlias
     * @return SqlTable
     */
    public function setColumnValue( $columnName , $value = null , $autoAlias = true )
    {
        $Column = ( $autoAlias ) ? new SqlColumn( $this->getAlias().__DOT__.$columnName ) : new SqlColumn( $columnName );
        $Column->setValue( $value );

        $this->getColumnManager()->addColumn( $Column );

        return $this;
    }

    /**
     * @param array $columnsName
     * @param bool $autoAlias
     * @return SqlTable
     */
    public function setColumns( array $columnsName , $autoAlias = true )
    {
        foreach( $columnsName AS $columnName )
        {
            $Column = ( $autoAlias ) ? new SqlColumn( $this->getAlias().__DOT__.$columnName ) : new SqlColumn( $columnName );
            $this->getColumnManager()->addColumn( $Column );
        }

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        if ( $this->alias )
            return $this->getName() . " AS " .$this->getAlias();

        return $this->getName();
    }

}