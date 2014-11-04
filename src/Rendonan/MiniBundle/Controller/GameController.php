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

        if ($sessionData["online"]) //if user is logged in, display game, otherwise forward
        {
            return $this->render('RendonanMiniBundle:Default:Pages/game.html.twig',
                array(
                    'online'    => $sessionData["online"],
                    'name'      => $sessionData["username"]
                ));
        }
        else
        {
            //not logged in, redirect to registration page
            return $this->redirect($this->generateUrl("rendonan_mini_registration"));
        }
    }
}
