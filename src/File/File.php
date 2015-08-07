<?php

namespace MonoKit\File;

use MonoKit\Manager\Entity;
use MonoKit\Foundation\Exception\Exception;

/**
 * Cette classe gère un fichier sélectionné sur le serveur.
 *
 * @author Micka VAN HAREN
 * @version 07/2015
 */
Class File extends Entity
{
	/** @var string */
	protected $file;

    /**
     * @param string $file
     * @throws Exception
     */
	public function __construct( $file )
	{
		$this->setFile( $file );
	}

	/**
	 * @param string $file
	 * @return File
	 */
	public function setFile( $file )
	{
		$this->file = $file;

		return $this;
	}

	/**
	 * Retourne le chemin du fichier
	 *
	 * @example $File->get();
	 * @return string
	 */
	public function getFile()
	{
		return $this->file;
	}
	
	/**
	 * Retourne le contenu du fichier
	 *
	 * @example $File->getContent();
	 * @return string|null
	 */
	public function getContent()
	{
		if ( $this->isFile() )
			if ( $content = implode ('', file( $this->file ) ) )
				return $content;

		return null;
	}
	
	/**
	 * Retourne le nom du fichier s�lectionn�.
	 *
	 * @example $File->getName(); 
	 * @return string // nom_du_fichier.ext
	 */
	public function getName()
	{
		return basename( $this->file );
	}
	
	/**
	 * Retourne le nom du fichier s�lectionn� sans extension.
	 *
	 * @example $File->getShortName();
	 * @return string Nom du fichier // nom_du_fichier sans extension
	 */
	public function getShortName()
	{
		$fileName = explode( '.' , $this->getName() , 2 );
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
		return filetype( $this->file ); 
	}

	/**
	 * Retourne l'extension du fichier sélectionné
	 *
	 * @example $File->getExtension(); // php
	 * @return string
	 */
	public function getExtension()
	{
		$fileName = explode( '.' , $this->getName() );
		return $fileName[ count( $fileName ) - 1 ];
	}
	
	/**
	 * The size of the file on the local disk in kilobytes.
	 *
	 * @example $File->getSize();
	 * @return int
	 */
	public function getSize()
	{
		return ( isset( $this->file ) ) ? number_format( filesize( $this->file ) / 1024 , 1, ',', '' ) : null;
	}
	
	/**
	 * The date that the file on the local disk was last modified.
	 *
	 * @example $File->getModificationDate(); // 2013-06-14
	 * @return string
	 */
	public function getModificationDate()
	{
		return date( "Y-m-d" , filemtime( $this->file ) );
	}
	
	/**
	 * Lit les droits d'un fichier.
	 *
	 * @example $File->getPerms();
	 * @return int
	 */
	public function getPerms()
	{
		return fileperms( $this->file );
	}

	/**
	 * Indique si un fichier est un v�ritable fichier.
	 *
	 * @example $File->isFile();
	 * @return boolean
	 */
	public function isFile()
	{
		return is_file( $this->file );
	}

	/**
	 * Indique si le fichier est ex�cutable.
	 *
	 * @example $File->is_executable();
	 * @return boolean
	 */
	public function is_executable()
	{
		return is_executable( $this->file );
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
		rename( $this->file , $newName );
		$this->file = $newName;
		return $this;
	}

	/**
	 * Duplique le fichier.
	 *
	 * @example $File->duplicate( 'nouveau_nom.ext' );
	 * @param string $newName Nom du fichier avec extension
	 * @return File
	 */
	public function duplicate( $newName )
	{
		copy( $this->file , $newName );
		return $this;
	}
	
	/**
	 * Efface un fichier.
	 *
	 * @example $File->remove();
	 * @return boolean
	 */
	public function remove()
	{
		return unlink( $this->file );
	}

	
}

?>