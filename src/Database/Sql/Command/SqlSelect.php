<?php

namespace MonoKit\Database\Sql\Command;

use MonoKit\Foundation\Foundation;
use MonoKit\Database\Sql\SqlInterface;
use MonoKit\Database\Sql\Manager\SqlTableManager;
use MonoKit\Database\Sql\Manager\Entity\SqlTable;
use MonoKit\Database\Sql\Manager\Entity\SqlLeftJoinTable;
use MonoKit\Database\Sql\Manager\Entity\SqlRightJoinTable;
use MonoKit\Database\Sql\Manager\Entity\SqlInnerJoinTable;

class SqlSelect extends Foundation implements SqlInterface
{
    /** @var SqlTable */
    protected $table;
    /** @var SqlTableManager */
    protected $JoinTableManager;

    /**
     * @param string $tableName
     * @param string|null $tableAlias
     */
    public function __construct($tableName, $tableAlias = null)
    {
        $this->table = new SqlTable($tableName, $tableAlias);
        $this->JoinTableManager = new SqlTableManager();
    }

    /**
     * @param string $columns
     * @return SqlSelect
     */
    public function setColumns($columns)
    {
        $this->table->setColumns(explode(",", $columns));
        return $this;
    }

    /**
     * @param string $tableName
     * @param string $columns
     * @param string $condition
     * @return SqlSelect
     */
    public function setInnerJoin($tableName, $columns, $condition)
    {
        $Table = new SqlInnerJoinTable($tableName);
        $Table->setColumns(explode(",", $columns));
        $Table->setCondition($condition);

        $this->JoinTableManager->addTable($Table);

        return $this;
    }

    /**
     * @param string $tableName
     * @param string $columns
     * @param string $condition
     * @return SqlSelect
     */
    public function setLeftJoin($tableName, $columns, $condition)
    {
        $Table = new SqlLeftJoinTable($tableName);
        $Table->setColumns(explode(",", $columns));
        $Table->setCondition($condition);

        $this->JoinTableManager->addTable($Table);

        return $this;
    }

    /**
     * @param string $tableName
     * @param string $columns
     * @param string $condition
     * @return SqlSelect
     */
    public function setRightJoin($tableName, $columns, $condition)
    {
        $Table = new SqlRightJoinTable($tableName);
        $Table->setColumns(explode(",", $columns));
        $Table->setCondition($condition);

        $this->JoinTableManager->addTable($Table);

        return $this;
    }

    /**
     * @param string $condition
     * @return SqlSelect
     */
    public function where($condition)
    {
        $this->table->setCondition($this->table->getAlias() . __DOT__ . $condition);
        return $this;
    }

    /**
     * @param string $order
     * @return SqlSelect
     */
    public function order($order)
    {
        $this->table->setOrder($this->table->getAlias() . __DOT__ . $order);
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $columnArray = array();
        $joinTableArray = array();

        $columnArray[] = $this->table->getColumnManager()->toString();

        foreach ( $this->JoinTableManager as $joinTable )
        {
            $joinTableArray[] = $joinTable->toString();
            $columnArray[] = $joinTable->getColumnManager()->toString();
        }

        return sprintf("SELECT %s FROM %s %s %s %s",    implode(", ", $columnArray),
                                                        $this->table->toString(),
                                                        implode(__SPACE__, $joinTableArray),
                                                        $this->table->getCondition(),
                                                        $this->table->getOrder());

    }
}
