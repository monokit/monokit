<?php

namespace MonoKit\Component\Notify;

use MonoKit\EntityManager\EntityManager;

Class NotifyManager extends EntityManager
{
    public function addNotify( Notify $notify )
    {
        return parent::add( $notify );
    }
}