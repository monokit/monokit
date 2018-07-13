<?php

namespace MonoKit\Http\Response\Interfaces;

interface ResponseInterface
{
    public function setContent();
    public function getContent();
    public function render();
}