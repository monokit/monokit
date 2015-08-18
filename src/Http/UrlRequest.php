<?php

namespace MonoKit\Http;

use MonoKit\Manager\Entity;

Class UrlRequest extends Entity
{
    const GET = "GET";
    const PUT = "PUT";
    const POST = "POST";
    const HEAD = "HEAD";
    const DELETE = "DELETE";

    /** @var string */
    protected $url;
	/** @var string */
	protected $method;

    /**
     * @param string $url
     * @param string $method
     */
    public function __construct( $url = "/" , $method = "GET" )
    {
        $this->setUrl( $url );
        $this->setMethod( $method );
    }

    /**
     * @param string $url
     * @return UrlRequest
     */
    public function setUrl( $url )
    {
        $this->url = ( $url != "/" ) ? rtrim( $url , "/" ) : $url; // Supprime le dernier "/"
        $this->url = str_replace( "//" , "/" , $this->url );
        $this->url = strtolower( $this->url );
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

	/**
	* @param string $method
	* @return UrlRequest
	*/
	public function setMethod( $method = "GET" )
    {
        switch ( strtoupper( $method ) )
        {
            case "POST":
                $this->method = self::POST;
                break;
            case "PUT":
                $this->method = self::PUT;
                break;
            case "DELETE":
                $this->method = self::DELETE;
                break;
            default:
                $this->method = self::GET;
        }

		return $this;
	}

	/**
	* @return string
	*/
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return bool
     */
    public function is( $method )
    {
        return ( $this->method == strtoupper( $method ) ) ? true : false;
    }

    /**
     * Retourne un tableau contenant tous les paramètres trouvés dans l'url fournie.
     *
     * @param UrlRequest $urlRequest
     * @return array
     */
    public function getParametersValue( UrlRequest $urlRequest )
    {
        return array_diff( explode( "/" , $urlRequest->getUrl() ) , explode( "/" , $this->getUrl() ) );
    }

    /**
     * @return UrlRequest
     */
    public function autoDetect()
    {
        $this->setUrl( "/".$_SERVER["QUERY_STRING"] );
        $this->setMethod( $_SERVER["REQUEST_METHOD"] );

        return $this;
    }
	
}

?>