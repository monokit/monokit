<?php

namespace MonoKit\Http\Response;

use MonoKit\View\ViewFile;

Class ResponseHtml extends Response
{
    const CONTENT_TYPE = "text/html";

    public function render( $viewFile = null )
    {
        $this->getHeader();

        $View = new ViewFile();
        echo $View->render( $viewFile , $this->getContent() );
    }
}