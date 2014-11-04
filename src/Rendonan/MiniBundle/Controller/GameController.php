<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;

class GameController extends Controller
{
    public function indexAction()
    {
        $session        = new GetSession();
        $sessionData    = $session->getData();

        return $this->render('RendonanMiniBundle:Default:Pages/game.html.twig',
            array(
                'online'    => $sessionData[1],
                'name'      => $sessionData[2]
            ));
    }
}
