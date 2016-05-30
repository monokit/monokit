<?php

namespace MonoKit\View;

use MonoKit\EntityManager\Entity;
use MonoKit\Foundation\Foundation;
use MonoKit\Foundation\Interfaces\StringInterface;

Class RenderEntity extends Foundation implements StringInterface
{
    /** @var mixed */
    protected $template;
    /** @var Entity */
    protected $Entity;

    public function __construct( $template , Entity $entity = null )
    {
        $this->setTemplate($template);
        $this->setEntity($entity);
    }

    /**
     * @param $template
     * @return $this
     */
    protected function setTemplate( $template )
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param Entity $entity
     * @return $this
     */
    protected function setEntity( Entity $entity )
    {
        $this->Entity = $entity;
        return $this;
    }

    /**
     * @return Entity
     */
    protected function getEntity()
    {
        return $this->Entity;
    }

    /**
     * @return string
     */
    protected function process()
    {
        $template = $this->getTemplate();

        if ( preg_match_all( '/{{([\"\.\:\w]+)}}/', $template , $fields ) )
            foreach ( $fields[0] AS $key => $value )
            {

                $template = str_replace( $value , $this->getEntity()->get( $this->strip($value) ) , $template );
            }


        return $template;
    }

    /**
     * @param $value
     * @return string
     */
    public function strip( $value )
    {
        return substr( $value , 2 , -2 );
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->process();
    }
}