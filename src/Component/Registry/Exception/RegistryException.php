<?php

namespace MonoKit\Component\Registry\Exception;

use MonoKit\Foundation\Exception\FoundationException;

Class RegistryException extends FoundationException
{
    Const ERROR_EMPTY_KEY = "La clé ne peut-être une chaine vide.";
    Const ERROR_ASSIGN_KEY = "La clé spécifiée ne peut-être assignée.";
}