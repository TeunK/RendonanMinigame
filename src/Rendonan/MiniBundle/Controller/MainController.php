<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends Controller
{
    public function indexAction()
    {
        $session = new Session();

        if ($session->get('online'))
        {
            $username = $session->get('username');
        }
        else
        {
            $username = "no sessionname";
        }
        return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
            array(
                'name' => $username
            ));
    }

}
