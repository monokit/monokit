<?php

namespace MonoKit\Component\Database\Exception;

use MonoKit\Foundation\Exception\FoundationException;

class DatabaseException extends FoundationException
{
    Const ERROR_ACCESS              = "Aucune connexion trouvée...";
    Const ERROR_ACCESS_MYSQLI       = "Aucune connexion Mysqli trouvée...";
    Const ERROR_ACCESS_PDO          = "Aucune connexion PDO trouvée...";
}