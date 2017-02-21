<?php

namespace MonoKit\View;

use MonoKit\Component\File\File;
use MonoKit\Component\File\Exception\FileException;
use MonoKit\EntityManager\Entity;
use MonoKit\View\Exception\ViewFileException;
use MonoKit\View\Interfaces\ViewFileInterface;

Class ViewFile extends View implements ViewFileInterface
{
    Const VIEW_SUFFIX = ".view.php";

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
            throw new ViewFileException( FileException::ERROR_LOADING_FILE , $this , $file->getFilePath() );

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
        // Vérification de l'existence d'une extension ( VIEW_SUFFIX )
        $viewFilePath = ( substr($viewFilePath, -strlen(self::VIEW_SUFFIX) ) == self::VIEW_SUFFIX) ? $viewFilePath : $viewFilePath . self::VIEW_SUFFIX;

        $viewFilePath = ( preg_match('/@(?P<AppName>\w+):/', $viewFilePath , $matches ) )
            ? "@{$matches["AppName"]}:" . self::VIEW_DIRECTORY . __DS__ . end( explode("@{$matches['AppName']}:" , $viewFilePath , 2 ) )
            : "../" . self::VIEW_DIRECTORY . __DS__ . $viewFilePath;

        $this->setFile( new File( $viewFilePath ) );

        if ( $data )
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