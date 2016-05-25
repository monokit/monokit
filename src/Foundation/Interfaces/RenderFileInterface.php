<?php

namespace MonoKit\Foundation\Interfaces;

interface RenderFileInterface
{
    /**
     * @param string $viewFile
     * @param mixed|null $data
     * @return mixed
     */
    public function render( $viewFile , $data = null );
}