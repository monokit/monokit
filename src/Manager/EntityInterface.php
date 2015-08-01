<?php

namespace MonoKit\Manager;

Interface EntityInterface
{
    public function setProperties( array $array );

    public function setProperty( $property , $value );

    public function getProperty( $property );
}