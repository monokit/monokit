<?php

namespace MonoKit\EntityManager\Exception;

use MonoKit\Foundation\Exception\FoundationException;

Class EntityManagerMysqliException extends FoundationException
{
    const SERVICE_NOTFOUND = "Aucun MysqliService trouvé...";
}