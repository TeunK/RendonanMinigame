<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RendonanMiniBundle:Default:index.html.twig', array('name' => $name));
    }
}
