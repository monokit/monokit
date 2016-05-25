<?php

namespace MonoKit\Component\Html\SupportClass;

use MonoKit\EntityManager\EntityManager;

Class HtmlAttributeManager extends EntityManager
{
    public function add( HtmlAttribute $htmlAttribute )
    {
        if ( $_htmlAttribute = $this->find( "key" , $htmlAttribute->getKey() )->getFirst() )
        {
            $_htmlAttribute->setValue( $htmlAttribute->getValue() );
            return $this;
        }

        return parent::add( $htmlAttribute );
    }
}