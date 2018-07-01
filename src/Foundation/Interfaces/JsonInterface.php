<?php

namespace MonoKit\Foundation\Interfaces;

interface JsonInterface
{
    /**
     * @param bool $displayAsNull
     * @return mixed
     */
    public function toJson( $displayAsNull = false );
}