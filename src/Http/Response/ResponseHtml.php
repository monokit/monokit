<?php

namespace MonoKit\Http\Response;

use MonoKit\View\ViewFile;

Class ResponseHtml extends Response
{
    const RESPONSE_HEADER = "Content-Type: text/html";

    public function render( $viewFile = null )
    {
        $View = new ViewFile();
        echo $View->render( $viewFile , $this->getContent() );
    }
}