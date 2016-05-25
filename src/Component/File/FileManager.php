<?php

namespace MonoKit\Component\File;

use MonoKit\EntityManager\EntityManager;

Class FileManager extends EntityManager
{
    /**
     * @param File $file
     * @return FileManager
     */
    public function add( File $file )
    {
        return parent::add( $file );
    }

}