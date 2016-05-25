<?php

namespace MonoKit\Controller;

use MonoKit\Component\Html\Tag\H1;
use MonoKit\EntityManager\Entity;
use MonoKit\View\View;

Abstract Class Controller extends Entity
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return new H1( "It's Work!" );
    }

    /**
     * @param $viewFile
     * @param mixed|null $data
     * @return string
     */
    public function render( $viewFile , $data = null )
    {
        $View = new View();
        return $View->render( $viewFile , $data );
    }

    /**
     * @return string
     */
    public function error404()
    {
        return new H1( "Erreur 404" );
    }
}