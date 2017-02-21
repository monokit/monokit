<?php

namespace MonoKit\View;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Notify\NotifyManager;
use MonoKit\EntityManager\Entity;

Class View extends Entity
{
    Const VIEW_DIRECTORY = "View";
    Const VIEW_SUFFIX = "View";

    /** @var mixed */
    protected $data;

    /**
     * @param mixed $data
     * @return ViewFile
     */
    protected function setData( $data )
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @param mixed|null $value
     * @param mixed|null $defaultValue
     * @return mixed
     */
    public function AppRegistry( $key = AppRegistry::APPLICATION , $value = null , $defaultValue = null )
    {
        return AppRegistry::AppRegistry( $key , $value , $defaultValue );
    }

    /**
     * @return NotifyManager
     */
    public function getNotifyManager()
    {
        return AppRegistry::AppRegistry( AppRegistry::APPLICATION_NOTIFY );
    }

    /**
     * @param string $viewFilePath
     * @param mixed|null $data
     * @return mixed
     */
    public function render( $viewFilePath , $data = null )
    {
        $ViewFile = new ViewFile();
        return $ViewFile->render( $viewFilePath , ( !is_null($data) ) ? $data : $this->getData() );
    }

}
