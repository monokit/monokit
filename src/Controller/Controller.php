<?php

namespace MonoKit\Controller;

use MonoKit\App\AppRegistry;
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
        return $this->html( "<H1>It's Work!</H1>" );
    }

    /**
     * @param mixed $data
     * @param int $status
     * @return ResponseHtml
     */
    public function html( $data = null , $status = 200 )
    {
        return new ResponseHtml( $data , $status );
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
     * @param string $viewFile
     * @param mixed $data
     * @param int $status
     * @return ResponseHtml
     */
    public function render( $viewFile , $data = null , $status = 200 )
    {
        $View = new ViewFile();
        return $this->html( $View->render( $viewFile , $data ) , $status );
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
    static public function error404()
    {
        return new ResponseHtml( "<H1>Ooops, 404 not found...</H1>" , 404 );
    }
}
