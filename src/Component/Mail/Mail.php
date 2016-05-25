<?php

namespace MonoKit\Component\Mail;

use MonoKit\Component\File\File;
use MonoKit\Foundation\Foundation;

class Mail extends Foundation
{
    /** @var string */
    protected $senderMail;
    /** @var string */
    protected $subject = "No subject";
    /** @var string */
    protected $body;

    /**
     * @param $senderMail
     * @return Mail
     */
    public function setSenderMail( $senderMail )
    {
        $this->senderMail = ( filter_var( $senderMail , FILTER_VALIDATE_EMAIL) ) ? $senderMail : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderMail()
    {
        return $this->senderMail;
    }

    /**
     * @param $subject
     * @return Mail
     */
    public function setSubject( $subject )
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param $html
     * @return Mail
     */
    public function setBody( $html )
    {
        $this->body = $html;
        return $this;
    }

    /**
     * @param File $file
     * @return Mail
     */
    public function setBodyFromFile( File $file )
    {
        $this->body = $file->getContent();
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function send( $email )
    {
        $email = ( filter_var( $email , FILTER_VALIDATE_EMAIL) ) ? $email : null;

        if ( $this->getBody() && $this->getSenderMail() && $email )
        {
            $content  		= "From:{$this->getSenderMail()}\n";
            $content		.= "MIME-version: 1.0\n";
            $content		.= "Content-type: text/html; charset= iso-8859-1\n";

            return mail( $email , $this->getSubject() , $this->getBody() , $content );
        }

        return false;
    }
}