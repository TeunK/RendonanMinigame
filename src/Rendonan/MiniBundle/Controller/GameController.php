<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;
use Rendonan\MiniBundle\Entity\Account;

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

    //receives user data
    public function loaddataAction()
    {
        //init session
        $session        = new GetSession();
        $sessionData    = $session->getData();

        //bypass SSX security issues that would otherwise occur in certain browsers when trying to connect game using http_get():
        //this allows cross-domain access to happen
        if (isset($_SERVER["HTTP_ORIGIN"]))
        {
            //only allow access to local domain
            $http_origin = $_SERVER['HTTP_ORIGIN'];
            if ($http_origin == "http://127.0.0.1:51268")
            {
                header('Access-Control-Allow-Origin: *');
            }
        }
        else
        {
            header('Access-Control-Allow-Origin: *');
        }

        //init user data to output in page for game to pick up
        $username   = "LOCAL PLAYER";
        $xp         = 999999;
        $coins      = 999999;
        $maxhp      = 10000000;
        $currenthp  = 10000000;
        $strength   = 999999;
        $agility    = 0;

        if ($sessionData["online"]) //if user is logged in, display game, otherwise forward
        {
            //Init DB-Connection
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('RendonanMiniBundle:Account');
            $user = $repository->findOneBy(array('username' => $sessionData["username"]));

            // LOAD THIS DATA FROM THE DATABASE WHERE USERNAME = $sessionData['username']
            $username   = $user->getUsername();
            $xp         = $user->getUserExperience();
            $coins      = $user->getUserCoins();
            $maxhp      = $user->getStatHp();
            $currenthp  = $user->getStatHp();
            $strength   = $user->getStatStrength();
            $agility    = $user->getStatAgility();

        }

        return $this->render('RendonanMiniBundle:Default:HTTPrequests/userdata.html.twig',
            array(
                'name'      => $username,
                'xp'        => $xp,
                'coins'     => $coins,
                'maxhp'     => $maxhp,
                'currenthp' => $currenthp,
                'strength'  => $strength,
                'agility'   => $agility
            ));
    }

    //executes user game-save into database
    public function savedataAction()
    {
        return $this->redirect($this->generateUrl("rendonan_mini_registration"));
    }
}
