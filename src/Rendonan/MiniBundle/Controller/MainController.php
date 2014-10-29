<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
            array(
                'name' => 'name'
            ));
    }

}
