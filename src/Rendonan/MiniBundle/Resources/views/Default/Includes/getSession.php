<?php

    $session = new Session();

    if ($session->get('online'))
    {
        $username = $session->get('username');
    }
    else
    {
        $username = "no sessionname";
    }