<?php

namespace MonoKit\Foundation\Interfaces;

interface ArrayInterface
{
    /**
     * @param bool $displayAsNull
     * @return array
     */
    public function toArray( $displayAsNull = false );
}