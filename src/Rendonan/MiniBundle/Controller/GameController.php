<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class GameController extends Controller
{
    public function indexAction()
    {
        $session = new Session();
        $username = $session->get('username');
        return $this->render('RendonanMiniBundle:Default:Pages/game.html.twig',
            array(
                'name' => 'name'.$username
            ));
    }
}
