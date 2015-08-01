<?php

namespace MonoKit\File;

use MonoKit\Manager\EntityManager;

class FileManager extends EntityManager
{
    /**
     * @param string $directory
     * @return FileManager
     */
    public function getFilesFromDirectory( $directory )
    {
        if ( is_dir($directory) )
            foreach (scandir($directory) AS $file) {
                if (substr($file, 0, 1) != ".") {
                    $File = new File(rtrim($directory, "/") . "/" . $file);

                    if ($File->isFile())
                        $this->add($File);
                }
            }

        return $this;
    }
}