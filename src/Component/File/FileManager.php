<?php

namespace MonoKit\Component\File;

use MonoKit\EntityManager\EntityManager;

Class FileManager extends EntityManager
{
    /**
     * @param Directory $directory
     * @return FileManager
     */
    public function getFilesFromDirectory( Directory $directory )
    {
        $this->removeAll();

        if ( $directory->isDir() )
            foreach ( scandir( $directory->getPath() ) AS $file )
            {
                if (substr($file, 0, 1) != ".")
                {
                    $File = new File( rtrim($directory->getPath(), "/") . "/" . $file );

                    if ( $File->isFile() )
                        $this->add( $File );
                }
            }

        return $this;
    }
}