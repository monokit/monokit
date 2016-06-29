<?php

namespace MonoKit\Controller;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Html\Tag\H1;
use MonoKit\Controller\Exception\ControllerException;
use MonoKit\EntityManager\Entity;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Http\Response\ResponseJson;
use MonoKit\Http\UrlRequestDiscover;
use MonoKit\Routing\Route;
use MonoKit\View\ViewFile;

Abstract Class Controller extends Entity
{
    Const CONTROLLER_DIRECTORY          = "Controller";
    Const CONTROLLER_SUFFIX             = "Controller";
    Const CONTROLLER_METHOD_SUFFIX      = "Action";

    /**
     * @return string
     */
    public function indexAction()
    {
        return new ResponseHtml( "<H1>It's Work!</H1>" );
    }

    /**
     * @param mixed $data
     * @param int $status
     * @return ResponseJson
     */
    public function json( $data = null , $status = 200 )
    {
        return new ResponseJson( $data , $status );
    }

    /**
     * @param $viewFile
     * @param mixed|null $data
     * @return string
     */
    public function render( $viewFile , $data = null )
    {
        $View = new ViewFile();
        return new ResponseHtml( $View->render( $viewFile , $data ) );
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
     * @return UrlRequestDiscover
     */
    public function getUrlRequest()
    {
        return new UrlRequestDiscover();
    }

    /**
     * @return string
     */
    public function error404()
    {
        return new ResponseHtml( "<H1>Erreur 404</H1>" , 404 );
    }


}
