<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;

class HighscoreController extends Controller
{
    public function indexAction()
    {
        $session        = new GetSession();
        $sessionData    = $session->getData();

        return $this->render('RendonanMiniBundle:Default:Pages/highscore.html.twig',
            array(
                'online'    => $sessionData["online"],
                'name'      => $sessionData["username"]
            ));
    }

}
