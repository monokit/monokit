<?php

namespace MonoKit\Http;

use MonoKit\Manager\Entity;

Class UrlRequest extends Entity
{
    const GET       = "GET";
    const PUT       = "PUT";
    const POST      = "POST";
    const HEAD      = "HEAD";
    const DELETE    = "DELETE";

    /** @var string */
    protected $url = "/";
	/** @var string */
	protected $method = self::GET;
    /** @var array */
    protected $params;

    /**
     * @param string $url
     * @return UrlRequest
     */
    public function setUrl( $url )
    {
        // Supprime le dernier "/"
        $this->url = ( $url != "/" ) ? rtrim( $url , "/" ) : $url;
        $this->url = str_replace( "//" , "/" , $this->url );

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
     * @return string
     */
    public function getFullUrl()
    {
        return rtrim( __ROOT__ , "/" ) . $this->getUrl();
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
     * @param string $key
     * @param mixed|null $value
     * @return UrlRequest
     */
    public function setParam( $key , $value = null )
    {
        $this->params[strtoupper($key)] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getParam( $key )
    {
        return $this->params[strtoupper($key)];
    }

    /**
     * Retourne un tableau contenant tous les paramètres trouvés dans l'url fournie.
     *
     * @param UrlRequest $urlRequest
     * @return array
     */
    public function getParametersValue( UrlRequest $urlRequest )
    {
        return array_udiff( explode( "/" , $urlRequest->getUrl() ) , explode( "/" , $this->getUrl() ) , 'strcasecmp' );
    }

}