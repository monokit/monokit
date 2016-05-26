<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Select;
use MonoKit\EntityManager\Entity;
use MonoKit\EntityManager\EntityManager;
use MonoKit\EntityManager\Interfaces\EntityInterface;
use MonoKit\EntityManager\Interfaces\EntityManagerInterface;

Class FormSelect extends Select
{
    /** @var EntityManagerInterface */
    protected $EntityManager;
    /** @var Entity */
    protected $EntitySelected;

    /**
     * Select constructor.
     * @param EntityManagerInterface|null $entityManager
     */
    public function __construct( EntityManagerInterface $entityManager = null )
    {
        parent::__construct();

        $this->setEntityManager( $entityManager );
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Select
     */
    public function setEntityManager( EntityManagerInterface $entityManager )
    {
        $this->EntityManager = $entityManager;
        return $this;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->EntityManager;
    }

    /**
     * @param EntityInterface $entity
     * @return Select
     */
    public function setSelected( EntityInterface $entity )
    {
        $this->EntitySelected = $entity;
        return $this;
    }

    /**
     * @return Entity
     */
    public function getSelected()
    {
        return $this->EntitySelected;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName( $name )
    {
        return $this->name( $name );
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        if ( $this->getEntityManager() )
        {
            foreach ( $this->getEntityManager() AS $Entity )
            {
                $FormSelectOption = new FormSelectOption( $Entity );

                if ( $this->getSelected() && $Entity->getId() == $this->getSelected()->getId() )
                    $FormSelectOption->selected();

                $this->add( $FormSelectOption );
            }
        }

        return parent::toHtml();
    }

}