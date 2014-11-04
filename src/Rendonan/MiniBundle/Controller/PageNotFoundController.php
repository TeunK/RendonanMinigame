<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;

class PageNotFoundController extends Controller
{
    public function indexAction()
    {
        $session        = new GetSession();
        $sessionData    = $session->getData();

        return $this->render('RendonanMiniBundle:Default:Pages/404.html.twig',
            array(
                'online'    => $sessionData["online"],
                'name'      => $sessionData["username"]
            ));
    }
}
