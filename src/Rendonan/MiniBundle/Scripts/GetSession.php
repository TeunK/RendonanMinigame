<?php

namespace Rendonan\MiniBundle\Scripts;

use Symfony\Component\HttpFoundation\Session\Session;

class GetSession
{
    private $sessionID, $online, $username;

    public function __construct()
    {
        $this->session    =   new Session();
        $this->sessionID  =   $this->session->getId();
        $this->online     =   $this->session->get('online');

        if ($this->online)
        {
            $this->online     =   1;
            $this->username   =   $this->session->get('username');
        }
        else
        {
            $this->online     =   0;
            $this->username   =   "NULL";
        }
    }

    public function getData()
    {
        return array(
            $this->sessionID,
            $this->online,
            $this->username
        );
    }
}