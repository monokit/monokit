<?php

namespace MonoKit\Controller;

use MonoKit\Http\Response\ResponseJson;
use MonoKit\Manager\Entity;
use MonoKit\View\View;
use MonoKit\Http\Route;
use MonoKit\Http\RouteManager;
use MonoKit\Http\Response\ResponseHtml;

Class Controller extends Entity
{
    /**
     * @return ResponseHtml
     */
    public function indexAction()
    {
        return new ResponseHtml( "<H1>It works!!!</H1><H2>{$this}</H2>" );
    }

    /**
     * @param string $viewFile
     * @param mixed|null $data
     * @return mixed
     */
    protected function render( $viewFile , $data = null )
    {
        $view = new View();

        ob_start();

            $view->render( $viewFile , $data );
            $content = ob_get_contents();

        ob_end_clean();

        return new ResponseHtml( $content );
    }

    /**
     * @param mixed $data
     * @return ResponseJson
     */
    protected function renderJson( $data )
    {
        return new ResponseJson( $data );
    }

    /**
     * @param string $url
     */
    protected function redirect( $url )
    {
        header("Location: $url");
    }

    /**
     * @param Route $route
     */
    protected function redirectByRoute( Route $route )
    {
        $this->redirect( __ROOT__.$route->getUrlRequest()->getUrl() );
    }

    /**
     * @param $routeName
     * @throws ControllerException
     */
    protected function redirectByRouteName( $routeName )
    {
        $routeManager = new RouteManager();
        $routeManager->set( $this->AppRoute()->toArray() );

        if ( !$route = $routeManager->getRouteByName( $routeName ) )
            throw new ControllerException( ControllerException::ERROR_ROUTE , $this , $routeName );

        $this->redirectByRoute( $route );
    }

    public function error404()
    {
        exit("Erreur 404 !!!");
    }
}