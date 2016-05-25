<?php

namespace MonoKit\Foundation\Interfaces;

interface RenderInterface
{
    /**
     * @param mixed|null $data
     * @return mixed
     */
    public function render( $data = null );
}