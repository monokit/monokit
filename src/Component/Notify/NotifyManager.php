<?php

namespace MonoKit\Component\Notify;

use MonoKit\EntityManager\EntityManager;

Class NotifyManager extends EntityManager
{
    public function addNotify( NotifyInterface $notify )
    {
        return parent::add( $notify );
    }
}