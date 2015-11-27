<?php

namespace MonoKit\File;

use MonoKit\Foundation\Stringable;
use MonoKit\Manager\EntityManager;

class FileManager extends EntityManager implements Stringable
{
    /**
     * @param string $directory
     * @return FileManager
     */
    public function getFilesFromDirectory( $directory )
    {
        if ( is_dir($directory) )
            foreach (scandir($directory) AS $file)
            {
                if (substr($file, 0, 1) != ".") {
                    $File = new File(rtrim($directory, "/") . "/" . $file);

                    if ($File->isFile())
                        $this->add($File);
                }
            }

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $files = array();

        foreach( $this->toArray() AS $File )
            $files[] = $File->getFile();

        return implode( "," , $files );
    }
}