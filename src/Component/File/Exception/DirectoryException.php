<?php

namespace MonoKit\Component\File\Exception;

use MonoKit\Foundation\Exception\FoundationException;

Class DirectoryException extends FoundationException
{
    Const ERROR_LOADDING_DIR = "Le dossier spécifié est introuvable...";
    Const ERROR_PERMISSION = "Vous n'avez pas la permission d'écriture dans ce répertoire";
}