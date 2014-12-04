<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Response;


class GameController extends Controller
{
    public function indexAction()
    {
        $session        = new GetSession($this->get('session'));
        $sessionData    = $session->getData();

        //port number
        $port = "8080";

        if ($sessionData["online"]) //if user is logged in, display game, otherwise forward
        {
            return $this->render('RendonanMiniBundle:Default:Pages/game.html.twig',
                array(
                    'online'    => $sessionData["online"],
                    'name'      => $sessionData["username"],
                    'port'      => $port
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
        $session        = new GetSession($this->get('session'));
        $sessionData    = $session->getData();

        //bypass SSX security issues that would otherwise occur in certain browsers when trying to connect game using http_get():
        //this allows cross-domain access to happen
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin','*');
        $response->send();

        //init user data to output in page for game to pick up
        $username   = "LOCAL PLAYER";
        $xp         = 0;
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
            $currenthp  = $user->getHp();
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
    public function savedataAction(Request $request)
    {
        $session = $request->getSession();

        //bypass SSX security issues that would otherwise occur in certain browsers when trying to connect game using http_get():
        //this allows cross-domain access to happen
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin','*');
        $response->send();

        //fetch data from POST-data received from game
        if ($request->isMethod('POST')) {
            // data is an array with "name", "xp", "coins", "maxhp", "currenthp", "strength" and "agility" keys
            //$sessionData["username"] = $request->get('coins');
            $name       = $request->request->get('name');
            $xp         = $request->request->get('xp');
            $coins      = $request->request->get('coins');
            $maxhp      = $request->request->get('maxhp');
            $currenthp  = $request->request->get('currenthp');
            $strength   = $request->request->get('strength');
            $agility    = $request->request->get('agility');

            //Init DB-Connection
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('RendonanMiniBundle:Account');
            $user = $repository->findOneBy(array('username' => $session->get('username')));

            if ($user->getUsername() == $name)
            {
                $user->setUserExperience($xp);
                $user->setUserCoins($coins);
                $user->setStatHp($maxhp);
                $user->setHp($currenthp);
                $user->setStatStrength($strength);
                $user->setStatAgility($agility);

                $em->persist($user);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl("rendonan_mini_registration"));
    }
}
