<?php

namespace MonoKit\Database;

use MonoKit\Foundation\Exception\Exception;

class DatabaseException extends Exception
{
    Const ERROR_ACCESS = "Aucune connexion trouvée...";
    Const ERROR_ACCESS_MYSQLI = "Aucune connexion Mysqli trouvée...";
    Const ERROR_ACCESS_PDO = "Aucune connexion PDO trouvée...";
}