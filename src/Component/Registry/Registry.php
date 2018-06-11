<?php

namespace MonoKit\Component\Registry;

use MonoKit\EntityManager\Entity;
use MonoKit\Foundation\Interfaces\ArrayInterface;
use MonoKit\Foundation\Interfaces\JsonInterface;
use MonoKit\Component\Registry\Exception\RegistryException;
use MonoKit\Component\Registry\Interfaces\RegistryInterface;

Class Registry extends Entity implements RegistryInterface, ArrayInterface, JsonInterface
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
     * @param $key
     * @return bool
     */
    public function hasKey( $key )
    {
        return array_key_exists( $key , $this->data );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->listArray( $this->data );
    }

    public function toJson()
    {
        return json_encode( $this->toArray() );
    }

    /**
     * @param array $arr
     * @return array
     */
    protected function listArray( array $arr )
    {
        foreach( $arr as $key => $value )
            $arr[$key] = (is_array($value)) ? $this->listArray($value) : (( $value instanceof Entity ) ? $value->toArray() : $value);

        return $arr;
    }
}
