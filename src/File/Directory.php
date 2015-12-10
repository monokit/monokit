<?php

namespace MonoKit\File;

use MonoKit\Foundation\Foundation;

class Directory extends Foundation
{
    /**
     * @param string $dir
     * @param string $mode
     * @param bool|true $recursive
     * @return bool
     */
    public function create( $dir , $mode = "0777" , $recursive = true )
    {
        return mkdir( $dir , $mode , $recursive  );
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function delete( $dir )
    {
        $files = array_diff( scandir( $dir ) , array('.','..') );

        foreach ($files as $file)
            ( is_dir( "{$dir}/{$file}" ) ) ? $this->delete( "{$dir}/{$file}" ) : unlink( "{$dir}/{$file}" );

        return rmdir( $dir );
    }
}