<?php

namespace MonoKit\Component\File;

use MonoKit\Component\File\Exception\DirectoryException;
use MonoKit\EntityManager\Entity;
use MonoKit\Component\File\Exception\FileException;

Class File extends Entity
{
    /** @var string */
    protected $filePath;
    /** @var string */
    protected $content;

    /**
     * File constructor.
     * @param string|null $filePath
     */
    public function __construct( $filePath = null )
    {
        $this->setFilePath( $filePath );
    }

    /**
     * @param string $filePath
     * @return File
     */
    public function setFilePath( $filePath )
    {
        if ( preg_match('/@(?P<AppName>\w+):/', $filePath , $matches ) )
        {
            $filePath = end( explode("@{$matches['AppName']}:" , $filePath , 2 ) );
            $filePath = __SRC__ . $matches['AppName'] . __DS__ . $filePath;
        }

        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param string $content
     * @return File
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getFileContent()
    {
        return file_get_contents( $this->getFilePath() );
    }

    /**
     * @return null|string
     */
    public function getMimeType()
    {
        if ( !$this->getFilePath() )
            return null;

        switch( $this->getExtension() )
        {
            case 'css':
                return 'text/css';
            case 'js':
                return 'application/javascript';
            default:
                $fileInfo = new \finfo( FILEINFO_MIME_TYPE );
                return $fileInfo->file( $this->getFilePath() );
        }
    }

    /**
     * Retourne le nom du fichier sélectionné.
     *
     * @example $File->getName();
     * @return string // nom_du_fichier.ext
     */
    public function getName()
    {
        return basename( $this->getFilePath() );
    }

    /**
     * Retourne le nom du fichier sélectionné sans extension.
     *
     * @example $File->getShortName();
     * @return string Nom du fichier // nom_du_fichier sans extension
     */
    public function getShortName()
    {
        $fileName = explode( __DOT__ , $this->getName() , 2 );
        return $fileName[0];
    }

    /**
     * Retourne le type d'un fichier donné.
     *
     * @example $File->getType();
     * @return string Type du fichier
     */
    public function getType()
    {
        return filetype( $this->getFilePath() );
    }

    /**
     * Retourne l'extension du fichier sélectionné
     *
     * @example $File->getExtension(); // php
     * @return string
     */
    public function getExtension()
    {
        $fileName = explode( __DOT__ , $this->getName() );
        return strtolower( $fileName[ count( $fileName ) - 1 ] );
    }

    /**
     * The size of the file on the local disk in kilobytes.
     *
     * @example $File->getSize();
     * @return int
     */
    public function getSize()
    {
        return ( isset( $this->filePath ) ) ? number_format( filesize( $this->getFilePath() ) / 1024 , 1, ',', '' ) : null;
    }

    /**
     * The date that the file on the local disk was last modified.
     *
     * @return int
     */
    public function getModificationDate()
    {
        return filemtime( $this->getFilePath() );
    }

    /**
     * Lit les droits d'un fichier.
     *
     * @example $File->getPerms();
     * @return int
     */
    public function getPerms()
    {
        return fileperms( $this->getFilePath() );
    }

    /**
     * Indique si un fichier est un véritable fichier.
     *
     * @example $File->isFile();
     * @return bool
     */
    public function isFile()
    {
        return is_file( $this->getFilePath() );
    }

    /**
     * Indique si le fichier est ex�cutable.
     *
     * @example $File->is_executable();
     * @return bool
     */
    public function is_executable()
    {
        return is_executable( $this->getFilePath() );
    }

    /**
     * Renomme le fichier.
     *
     * @example $File->rename( 'nouveau_nom.ext' );
     * @param string $newName Nom du fichier avec extension
     * @return File
     */
    public function rename( $newName )
    {
        if ( !$this->isFile() )
            return false;

        rename( $this->getFilePath() , $newName );

        $this->setFilePath( $newName );

        return $this;
    }

    /**
     * @param string|null $fileName
     * @return File
     * @throws FileException
     */
    public function save( $fileName = null )
    {
        if ( !is_null( $fileName) )
            $this->setFilePath( $fileName );

        if ( !is_dir( dirname( $this->getFilePath() ) ) )
            throw new FileException( DirectoryException::ERROR_LOADDING_DIR , $this , dirname( $this->getFilePath() ) );

        if ( !is_writable( dirname( $this->getFilePath() ) ) )
            throw new FileException( DirectoryException::ERROR_PERMISSION , $this , dirname( $this->getFilePath() ) );

        $handle = fopen( $this->getFilePath() , 'w' );
        fwrite( $handle , $this->getContent() );
        fclose( $handle );

        return $this;
    }
}