<?php

namespace MonoKit\Component\Registry;

use MonoKit\Foundation\Foundation;
use MonoKit\Foundation\Interfaces\ArrayInterface;
use MonoKit\Component\Registry\Exception\RegistryException;
use MonoKit\Component\Registry\Interfaces\RegistryInterface;

class Registry extends Foundation implements RegistryInterface, ArrayInterface
{
    /** @var array */
    protected $data = array();

    /**
     * @param string $key
     * @param mixed $value
     * @param mixed $defaultValue
     * @return Registry
     * @throws RegistryException
     */
    public function set( $key , $value = null , $defaultValue = null )
    {
        if ( empty( $key ) )
            throw new RegistryException( RegistryException::ERROR_EMPTY_KEY , $this );

        $m = &$this->data;

        foreach ( explode( __DOT__ , strtoupper($key) ) as $registryKey )
            $m = &$m[$registryKey];

        $m = ( empty( $value ) ) ? $defaultValue : $value;

        $this->data = array_change_key_case( $this->data , CASE_UPPER );

        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws RegistryException
     */
    public function get( $key )
    {
        if ( empty( $key ) )
            throw new RegistryException( RegistryException::ERROR_EMPTY_KEY , $this );

        $m = $this->data;

        foreach ( explode( __DOT__ , strtoupper($key) ) as $k )
            $m = &$m[$k];

        return $m;
    }

    /**
     * @param string $key
     * @return bool
     * @throws RegistryException
     */
    public function has( $key )
    {
        return ( is_null( $this->get( strtoupper($key) ) ) ) ? false : true;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
    
}
