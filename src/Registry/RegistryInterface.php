<?php

namespace MonoKit\Registry;

Interface RegistryInterface
{
    /**
     * @param string $key
     * @param string $value
     * @return Registry
     */
    public function set( $key , $value );

    /**
     * @param string $key
     * @return Registry
     */
    public function get( $key );

    /**
     * @param string $key
     * @return Registry
     */
    public function has( $key );

}