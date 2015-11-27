<?php

namespace MonoKit\File;

class AssetException extends FileException
{
    Const ERROR_ASSET_NAME = "L'url de l'asset est mal formé. Il doit commencer par @{AppName}...";
}