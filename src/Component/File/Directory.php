<?php

namespace MonoKit\Component\File;

use MonoKit\EntityManager\Entity;

class Directory extends Entity
{
    /** @var string */
    protected $path;

    /**
     * Directory constructor.
     * @param string $path
     */
    public function __construct( $path )
    {
       $this->setPath($path);
    }

    /**
     * @param $path
     * @return Directory
     */
    public function setPath( $path )
    {
        // Supprime le dernier "/"
        $path = rtrim( $path , __DS__ );

        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return bool
     */
    public function isDir()
    {
        return is_dir( $this->getPath() );
    }

    /**
     * @param string $dirName
     * @param int $mode
     * @param bool|true $recursive
     * @return bool
     */
    public function create( $dirName , $mode = 0777 , $recursive = true )
    {
        $this->setPath( $this->getPath() . __DS__ . $dirName );

        if ( $this->isDir() )
            return false;

        $result = mkdir( $this->getPath() , $mode , $recursive );
                  chmod( $this->getPath() , $mode );

        return $result;
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function delete( $dir )
    {
        $files = array_diff( scandir( $dir ) , array('.','..') );

        foreach ($files as $file)
            ( is_dir( $dir . __DS__ .$file ) ) ? $this->delete( $dir . __DS__ . $file ) : unlink( $dir . __DS__ . $file );

        return rmdir( $dir );
    }
}