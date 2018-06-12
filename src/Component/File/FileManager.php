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

    /**
     * @param File $file
     * @param string $newName
     * @param int $mode
     * @return bool|void
     */
    public function duplicateFile( File $file , $newName , $mode = 0777 )
    {
        if ( !$file->isFile() )
            return false;

        @copy( $file->getFilePath() , $newName );
        @chmod( $newName , $mode );

        return $this;
    }

    /**
     * @param File $file
     * @return bool
     */
    public function removeFile( File $file )
    {
        if ( !$file->isFile() )
            return false;

        return unlink( $file->getFilePath() );
    }
}