<?php

namespace MonoKit\Component\Html;

use MonoKit\Component\Html\Tag\Option;
use MonoKit\EntityManager\Interfaces\EntityInterface;

Class FormSelectOption extends Option
{
    public function __construct( EntityInterface $entity = null )
    {
        parent::__construct();

        if ( $entity )
        {
            $this->label( $entity );
            $this->value( $entity->getId() );
        }
    }
}