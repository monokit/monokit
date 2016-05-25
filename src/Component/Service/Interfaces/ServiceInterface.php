<?php

namespace MonoKit\Component\Service\Interfaces;

interface ServiceInterface
{
    /**
     * @param string $name
     * @return ServiceInterface
     */
    public function setName( $name );

    /**
     * @return string
     */
    public function getName();

    /**
     * @return bool
     */
    public function isActive();
}