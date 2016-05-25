<?php

namespace MonoKit\App;


use MonoKit\EntityManager\Entity;
use MonoKit\Http\UrlRequestDiscover;
use MonoKit\Http\Response;
use MonoKit\Routing\Route;
use MonoKit\Routing\RouteManager;
use MonoKit\View\View;
use MonoKit\Component\File\File;
use MonoKit\Component\File\Exception\FileException;
use MonoKit\Component\Service\Interfaces\ServiceInterface;
use MonoKit\Controller\Exception\ControllerException;
use MonoKit\View\ViewFile;

Abstract Class App extends Entity
{
    /** @var Response */
    protected $response;

    /**
     * @param string $key
     * @param null $value
     * @param null $defaultValue
     * @return mixed
     */
    public function AppRegistry( $key = AppRegistry::APPLICATION , $value = null , $defaultValue = null )
    {
        return AppRegistry::AppRegistry( $key , $value , $defaultValue );
    }

    /**
     * @param File $iniFile
     * @return RouteManager
     * @throws FileException
     */
    public function setRouteManagerFromIniFile( File $iniFile )
    {
        if ( !$iniFile->isFile() )
            throw new FileException( FileException::ERROR_LOADING_FILE , $this , $iniFile );

        foreach( parse_ini_file( $iniFile->getFilePath() , true ) AS $routeName => $routeArray )
        {
            $route = new Route( $routeName );
            $route->serialize( $routeArray );

            $this->getRouteManager()->add( $route );
        }

        return $this;
    }

    /**
     * @param string $filePath
     * @return RouteManager
     * @throws FileException
     */
    public function setRouteManagerFromIniFilePath( $filePath )
    {
        return $this->setRouteManagerFromIniFile( new File( $filePath) );
    }

    /**
     * @return RouteManager
     */
    public function getRouteManager()
    {
        return AppRegistry::AppRegistry( AppRegistry::APPLICATION_ROUTES );
    }

    /**
     * @param ServiceInterface $service
     * @return mixed
     */
    public function addService( ServiceInterface $service )
    {
        return $this->AppRegistry( AppRegistry::APPLICATION_SERVICE.__DOT__.$service->getName() , $service );
    }

    /**
     * @param string $serviceName
     * @return ServiceInterface
     */
    public function getServiceByName( $serviceName )
    {
        return $this->AppRegistry( AppRegistry::APPLICATION_SERVICE.__DOT__.$serviceName );
    }

    /**
     * @return UrlRequestDiscover
     */
    public function getUrlRequest()
    {
        return new UrlRequestDiscover();
    }

    /**
     * @return Response
     */
    protected function getResponse()
    {
        return $this->response;
    }

    /**
     * @return mixed
     * @throws ControllerException
     */
    protected function getAppContent()
    {
        if ( !$Route = $this->getRouteManager()->getRouteByUrlRequest( $this->getUrlRequest() ) )
        {
            // ERROR 404
            $this->getResponse()->setStatus( 404 );
            return call_user_func( array( "{$this->getClassNamespace()}\\Controller\\AppController" , "error404" ) );
        }

        $controller = $this->getClassNamespace() . "\\Controller\\" . $Route->getControllerName();
        $action = $Route->getActionName();

        if ( !class_exists( $controller ) )
            throw new ControllerException( ControllerException::ERROR_CONTROLLER , $this , $controller );

        if ( !method_exists( $controller , $action ) )
            throw new ControllerException( ControllerException::ERROR_METHOD , $controller , $action );

        return call_user_func_array( array( new $controller() , $action ) , $Route->getParameters( $this->getUrlRequest() ) );
    }

    /**
     * @param string $viewFile
     * @return void
     * @throws ControllerException
     */
    public function render( $viewFile )
    {
        $this->response = new Response( 200 );

        $this->getResponse()->getHeader();

        $View = new ViewFile();
        echo $View->render( $viewFile );
    }

    /**
     * @return mixed|\MonoKit\Component\Registry\Registry
     */
    public function getSqlDatabaseHistory()
    {
        return $this->AppRegistry( "APPLICATION.DATABASE.SQL" );
    }
}