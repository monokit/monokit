<?php

namespace MonoKit\Component\File;

use MonoKit\EntityManager\EntityManager;

Class DirectoryManager extends EntityManager
{
    public function getDirectoryFromDirectory( Directory $directory )
    {
        $this->removeAll();

        if ( $directory->isDir() )
            foreach ( scandir( $directory->getPath() ) AS $dir )
            {
                $Directory = new Directory( rtrim( $directory->getPath() , "/" ) . "/" . $dir );

                if ( $Directory->isDir() )
                    $this->add( $Directory );
            }

        return $this;
    }
}