<?php

namespace MonoKit\Component\File;

use MonoKit\EntityManager\EntityManager;

Class DirectoryManager extends EntityManager
{
    /**
     * @param Directory $directory
     * @return EntityManager
     */
    public function addDirectory( Directory $directory )
    {
        if ( $directory->isDir() )
            $this->add( $directory );

        return $this;
    }

    /**
     * @param string $path
     * @return EntityManager
     */
    public function getDirectoryListFromPath( $path = __SRC__ )
    {
        $this->removeAll();

        foreach ( scandir( $path ) AS $dir )
            if (substr($dir, 0, 1) != ".")
                $this->addDirectory( new Directory( $path . __DS__ . $dir ) );

        return $this;
    }

    /**
     * @param Directory $directory
     * @return DirectoryManager
     */
    public function getDirectoryFromDirectory( Directory $directory )
    {
        $this->removeAll();

        if ( $directory->isDir() )
            foreach ( scandir( $directory->getPath() ) AS $dir )
            {
                if (substr($dir, 0, 1) != ".")
                {
                    $Directory = new Directory( rtrim( $directory->getPath() , "/" ) . "/" . $dir );

                    if ( $Directory->isDir() )
                        $this->addDirectory( $Directory );
                }
            }

        return $this;
    }
}