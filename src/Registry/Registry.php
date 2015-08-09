<?php

namespace MonoKit\Registry;

use MonoKit\File\File;
use MonoKit\File\FileException;
use MonoKit\Foundation\Arrayable;
use MonoKit\Foundation\Foundation;

class Registry extends Foundation implements RegistryInterface, Arrayable
{
    /** @var array */
    protected $data = array();

    /**
     * @param string $key
     * @param string $value
     * @return Registry
     * @throws RegistryException
     */
    public function set( $key , $value )
    {
        if ( empty( $key ) )
            throw new RegistryException( RegistryException::ERROR_EMPTY_KEY , $this );

        $m = &$this->data;

        foreach ( explode( "." , strtoupper($key) ) as $registryKey )
            $m = &$m[$registryKey];

        $m = $value;

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

        foreach ( explode( "." , strtoupper($key) ) as $k )
            $m = &$m[$k];

        return $m;
    }

    /**
     * @param string $iniFile
     * @return Registry
     * @throws FileException
     */
    public function setFromIniFile( $iniFile )
    {
        $file = new File( $iniFile );

        if ( !$file->isFile() )
            throw new FileException( FileException::ERROR_LOADING_FILE , $this , $file );

        foreach( parse_ini_file( $file->getFile() , true ) AS $key => $value )
            $this->set( $key , array_change_key_case( $value , CASE_UPPER ) );

        return $this;
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


