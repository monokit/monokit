<?php

namespace MonoKit\View;

use MonoKit\App\AppRegistry;
use MonoKit\Component\Notify\NotifyManager;
use MonoKit\EntityManager\Entity;

Class View extends Entity
{
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
        return $ViewFile->render( $viewFilePath , $data );
    }

}