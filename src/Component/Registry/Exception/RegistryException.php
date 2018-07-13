<?php

namespace MonoKit\Component\Registry\Exception;

use MonoKit\Foundation\Exception\FoundationException;

Class RegistryException extends FoundationException
{
    Const ERROR_ASSIGN_KEY = "La clé spécifiée ne peut-être assignée.";
}