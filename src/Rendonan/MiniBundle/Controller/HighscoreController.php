<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HighscoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('RendonanMiniBundle:Default:Pages/highscore.html.twig',
            array(
                'name' => 'name'
            ));
    }

}
