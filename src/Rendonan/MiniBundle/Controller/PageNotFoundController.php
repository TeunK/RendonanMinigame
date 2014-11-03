<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class PageNotFoundController extends Controller
{
    public function indexAction()
    {
        return $this->render('RendonanMiniBundle:Default:Pages/404.html.twig',
            array(
                'name' => 'name'
            ));
    }
}
