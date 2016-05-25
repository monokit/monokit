<?php

namespace MonoKit\Controller\Exception;

use MonoKit\Foundation\Exception\FoundationException;

Class ControllerException extends FoundationException
{
    Const ERROR_CONTROLLER  = "Le controlleur spécifié n'existe pas.";
    Const ERROR_ROUTE       = "La route spécifiée est introuvable.";
    Const ERROR_METHOD      = "La méthode spécifiée n'existe pas dans le controlleur.";
}