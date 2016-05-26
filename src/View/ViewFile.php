<?php

namespace MonoKit\View;

use MonoKit\Component\File\File;
use MonoKit\Component\File\Exception\FileException;
use MonoKit\EntityManager\Entity;
use MonoKit\View\Exception\ViewFileException;
use MonoKit\View\Interfaces\ViewFileInterface;

Class ViewFile extends View implements ViewFileInterface
{
    /** @var File */
    protected $file;

    /**
     * @param File $file
     * @return ViewFile
     * @throws ViewFileException
     */
    public function setFile( File $file )
    {
        if ( !$file->isFile() )
            throw new ViewFileException( FileException::ERROR_LOADING_FILE , $this , $file );

        $this->file = $file;
        return $this;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $viewFilePath
     * @param mixed|null $data
     * @return mixed
     */
    public function render( $viewFilePath , $data = null )
    {
        $viewFilePath = (substr($viewFilePath, strlen(__VIEWFILE_SUFFIX__) ) == __VIEWFILE_SUFFIX__) ? $viewFilePath : $viewFilePath . __VIEWFILE_SUFFIX__;

        $this->setFile( new File( "../" .__VIEW_DIRECTORY__ . __DS__ . $viewFilePath ) );
        $this->setData( $data );

        ob_start();

            require "{$this->getFile()->getFilePath()}";

            $content = ob_get_contents();

        ob_end_clean();

        if ( $data instanceof Entity )
        {
            $Render = new RenderEntity( $content , $data );
            return $Render->toString();
        }

        return $content;

    }
    
}