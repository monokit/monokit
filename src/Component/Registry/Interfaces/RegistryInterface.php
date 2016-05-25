<?php

namespace MonoKit\Component\Registry\Interfaces;

use MonoKit\Component\Registry\Registry;

Interface RegistryInterface
{
    /**
     * @param string $key
     * @param mixed $value
     * @return Registry
     */
    public function set( $key , $value );

    /**
     * @param string $key
     * @return mixed
     */
    public function get( $key );

    /**
     * @param string $key
     * @return boolean
     */
    public function has( $key );

}