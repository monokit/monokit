<?php

namespace MonoKit\Http\Response\Interfaces;

interface ResponseInterface
{
    public function getHeader();
    public function setContent();
    public function getContent();
    public function render( $viewFile = null );
}