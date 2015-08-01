<?php

namespace MonoKit\View;

use MonoKit\File\File;
use MonoKit\File\FileException;
use MonoKit\Foundation\Foundation;

Class View extends Foundation
{
    /** @var File */
    protected $file;
    /** @var mixed */
    protected $data;

    /**
     * @param File $file
     * @return View
     * @throws FileException
     */
    protected function setFile( File $file )
    {
        $this->file = $file;

        if ( !$this->file->isFile() )
            throw new FileException( FileException::ERROR_LOADING_FILE , $this , $file );

        return $this;
    }

    /**
     * @param string $filename
     * @return View
     * @throws FileException
     */
    protected function setFileFromString( $filename )
    {
        $file = new File( "../" . MONOKIT_APPLICATION_DIRECTORY_VIEW . "/" . $filename );
        return $this->setFile( $file );
    }

    /**
     * @return File
     */
    protected function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $data
     * @return View
     */
    protected function setData( $data )
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @param string $filename
     * @param mixed $data
     * @return string ViewFile content
     */
    public function render( $filename , $data = null )
    {
        $this->setFileFromString( $filename );
        $this->setData( $data );

        $file = $this->getFile();

        $content = require "{$file->getFile()}";

        return $content;
    }
}