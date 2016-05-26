<?php

namespace MonoKit\Controller;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Html\Tag\H1;
use MonoKit\Controller\Exception\ControllerException;
use MonoKit\EntityManager\Entity;
use MonoKit\Routing\Route;
use MonoKit\View\ViewFile;

Abstract Class Controller extends Entity
{
    Const CONTROLLER_DIRECTORY = "Controller";
    Const CONTROLLER_SUFFIX = "Controller";
    Const CONTROLLER_METHOD_SUFFIX = "Action";

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
        $View = new ViewFile();
        return $View->render( $viewFile , $data );
    }

    /**
     * @param string $url
     */
    protected function redirect( $url )
    {
        header("Location: " . str_replace( "//" , "/" , $url ));
        exit();
    }

    /**
     * @param Route $route
     */
    protected function redirectByRoute( Route $route )
    {
        $this->redirect( __ROOT__.$route->getUrl() );
    }

    /**
     * @param $routeName
     * @throws ControllerException
     */
    protected function redirectByRouteName( $routeName )
    {
        if ( !$route = AppRegistry::AppRegistry( AppRegistry::APPLICATION_ROUTES )->getRouteByName( $routeName ) )
            throw new ControllerException( ControllerException::ERROR_ROUTE , $this , $routeName );

        $this->redirectByRoute( $route );
    }

    /**
     * @return string
     */
    public function error404()
    {
        return new H1( "Erreur 404" );
    }
}
