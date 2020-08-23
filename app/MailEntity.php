<?php

namespace App;

class MailEntity {

    private $mailtTo, $mailFrom, $subject, $cc, $bcc, $view;
    

    public function __construct($mailtTo, $mailFrom, $subject, $cc, $bcc, $view)
    {
        $this->mailFrom = $mailFrom;
        $this->mailtTo = $mailtTo;
        $this->subject = $subject;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->view = $view;
    }
    /**
     * Get the value of mailtTo
     */ 
    public function getMailtTo()
    {
        return $this->mailtTo;
    }

    /**
     * Set the value of mailtTo
     *
     * @return  self
     */ 
    public function setMailtTo($mailtTo)
    {
        $this->mailtTo = $mailtTo;

        return $this;
    }

    /**
     * Get the value of mailFrom
     */ 
    public function getMailFrom()
    {
        return $this->mailFrom;
    }

    /**
     * Set the value of mailFrom
     *
     * @return  self
     */ 
    public function setMailFrom($mailFrom)
    {
        $this->mailFrom = $mailFrom;

        return $this;
    }

    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of cc
     */ 
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set the value of cc
     *
     * @return  self
     */ 
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get the value of bcc
     */ 
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Set the value of bcc
     *
     * @return  self
     */ 
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * Get the value of view
     */ 
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @return  self
     */ 
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }
}