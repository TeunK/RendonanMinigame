<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $session        = new GetSession();
        $sessionData    = $session->getData();

        return $this->render('RendonanMiniBundle:Default:index.html.twig',
            array(
                'online'    => $sessionData["online"],
                'name'      => $sessionData["username"]
            )
        );
    }
}
