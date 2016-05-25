<?php

namespace MonoKit\Foundation\Exception
{
    Class FoundationException extends \Exception
    {
        protected $class;
        protected $vars;
        protected $message;

        public function __construct( $message = "Erreur" , $class = __NAMESPACE__ , $vars = null )
        {
            $this->class = $class;
            $this->vars = $vars;
            $this->message = $message;

            parent::__construct( $message );
        }

        public function __toString()
        {
            require "ExceptionView.php";
            exit();
        }
    }
}

namespace
{
    function MonoKitException( Exception $e )
    {
        echo "ERREUR MONOKIT : ".$e;
    }

    set_exception_handler( 'MonoKitException' );
}