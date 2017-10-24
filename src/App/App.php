<?php

namespace MonoKit\App;

use MonoKit\EntityManager\Entity;
use MonoKit\Http\Response\Response;
use MonoKit\Http\Response\ResponseHtml;
use MonoKit\Http\UrlRequestDiscover;
use MonoKit\Routing\Route;
use MonoKit\View\ViewFile;
use MonoKit\Routing\RouteManager;
use MonoKit\Component\File\File;
use MonoKit\Component\File\Exception\FileException;
use MonoKit\Component\Service\Interfaces\ServiceInterface;
use MonoKit\Controller\Controller;
use MonoKit\Controller\Exception\ControllerException;

Abstract Class App extends Entity
{
    /** @var string */
    protected $mode = "PRODUCTION";
    /** @var string */
    protected $name;
    /** @var Response */
    protected $response;
    /** @var mixed */
    protected $AppContent;

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
     * @param RouteManager $routeManager
     * @return App
     */
    public function setRouteManager( RouteManager $routeManager )
    {
        AppRegistry::AppRegistry( AppRegistry::APPLICATION_ROUTES , $routeManager );
        return $this;
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
        return $this->setRouteManagerFromIniFile( new File( $filePath ) );
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
     * @return mixed|\MonoKit\Component\Registry\Registry
     */
    public function getSqlDatabaseHistory()
    {
        return $this->AppRegistry( AppRegistry::APPLICATION_DATABASE_SQL );
    }

    /**
     * @return UrlRequestDiscover
     */
    public function getUrlRequest()
    {
        return new UrlRequestDiscover();
    }

    /**
     * @param string $mode
     * @return App
     */
    public function setMode( $mode = "PRODUCTION" )
    {
        switch ( $this->mode = $mode )
        {
            case "DEV":
                ini_set( "display_startup_errors" , true );
                ini_set( "display_errors" , true );
                ini_set( "error_reporting" , E_ALL );
                break;

            default:
                ini_set( "display_startup_errors" , false );
                ini_set( "display_errors" , false );
                ini_set( "error_reporting" , false );
                break;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $name
     * @return App
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        if ( is_null( $this->name) )
            return $this->getClassNamespace();

        return $this->name;
    }

    /**
     * @return string
     */
    public function getAppName()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getAppRoot()
    {
        return __ROOT__;
    }

    /**
     * @return mixed
     */
    public function getAppContent()
    {
        return $this->AppContent;
    }

    /**
     * @param string $viewFile
     * @return void
     * @throws ControllerException
     */
    public function render( $viewFile )
    {
        $response = $this->getResponse();
        $response->getHeader();

        if ( $response instanceof ResponseHtml )
        {
            $this->AppContent = $response->getContent();

            $View = new ViewFile();
            $response->setContent( $View->render( $viewFile , $this ) );
        }

        $response->render();
    }

    /**
     * @return Response
     * @throws ControllerException
     */
    protected function getResponse()
    {
        // ERROR 404
        if ( !$Route = $this->getRouteManager()->getRouteByUrlRequest( $this->getUrlRequest() ) )
            return call_user_func( array( $this->getClassNamespace() . __NSS__ . Controller::CONTROLLER_DIRECTORY . __NSS__ ."AppController" , "error404" ) );

        $controller = $this->getClassNamespace() . __NSS__ . Controller::CONTROLLER_DIRECTORY . __NSS__ . $Route->getControllerName();
        $action = $Route->getActionName();

        if ( !class_exists( $controller ) )
            throw new ControllerException( ControllerException::ERROR_CONTROLLER , $this , $controller );

        if ( !method_exists( $controller , $action ) )
            throw new ControllerException( ControllerException::ERROR_METHOD , $controller , $action );

        $response = call_user_func_array( array( new $controller() , $action ) , $Route->getParameters( $this->getUrlRequest() ) );

        return ( !$response instanceof Response ) ? new Response( $response ) : $response;
    }
}


date_default_timezone_set('Europe/Paris');