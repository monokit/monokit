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
    public function __construct( $path = null )
    {
        if ( is_null( $path ) )
            $path = dirname(".");

       $this->setPath( $path );
    }

    /**
     * @param $path
     * @return Directory
     */
    public function setPath( $path )
    {
        // Supprime le dernier "/" & "\\"
        $path = rtrim( $path , __DS__ );
        $path = rtrim( $path , "\\" );

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
     * @return bool
     */
    public function rename( $dirName )
    {
        $oldPath = $this->getPath();

        $this->setPath( $this->getPath() . "/../" . $dirName );

        return rename( $oldPath , $this->getPath() );
    }

    /**
     * @return DirectoryManager
     */
    public function getDirectoryList()
    {
        $DirectoryManager = new DirectoryManager();
        return $DirectoryManager->getDirectoryFromDirectory( $this );
    }

    /**
     * @return FileManager
     */
    public function getFileList()
    {
        $FileManager = new FileManager();
        return $FileManager->getFilesFromDirectory( $this );
    }

    /**
     * @param string $dirName
     * @param int $mode
     * @param bool $recursive
     * @return Directory
     */
    public function create( $dirName , $mode = 0777 , $recursive = true )
    {
        if ( is_dir( $this->getPath() . __DS__ . $dirName) )
            return false;

        $result = mkdir( $this->getPath() . __DS__ . $dirName , $mode , $recursive );
        chmod( $this->getPath() . __DS__ . $dirName , $mode );

        return $this;
    }

    /**
     * @param string $dir
     * @return Directory
     */
    public function delete( $dirName )
    {
        $files = array_diff( scandir( $dirName ) , array('.','..') );

        foreach ($files as $file)
            ( is_dir( $dirName . __DS__ .$file ) ) ? $this->delete( $dirName . __DS__ . $file ) : unlink( $dirName . __DS__ . $file );

        rmdir( $dirName );

        return $this;
    }

}