<?php

namespace Rendonan\MiniBundle\Scripts;

use Symfony\Component\HttpFoundation\Session\Session;

class GetSession
{
    private $sessionID, $online, $username;

    public function __construct(Session $session)
    {
        $this->session    =   $session;
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
            "id" => $this->sessionID,
            "online" => $this->online,
            "username" => $this->username
        );
    }
}