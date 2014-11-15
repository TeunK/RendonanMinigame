<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;
use Symfony\Component\HttpFoundation\Request;
use Rendonan\MiniBundle\Entity\Highscore;

class HighscoreController extends Controller
{
    public function indexAction()
    {
        //init session
        $session        = new GetSession();
        $sessionData    = $session->getData();



        //Init DB-Connection
        //$em = $this->getDoctrine()->getManager();
        //$repository = $em->getRepository('RendonanMiniBundle:Account');
        //$user = $repository->findOneBy(array('username' => $sessionData["username"]));

        $em = $this->getDoctrine()->getManager();
        $tbl = $em->getClassMetadata('RendonanMiniBundle:Highscore')->getTableName();
        $orderstat  = "user_experience";
        $order      = "DESC";
        $limit      = 100;

        $query = "
            SELECT
                scores.username         AS user,
                scores.user_experience  AS xp,
                scores.user_coins       AS coins,
                scores.stat_hp          AS hp,
                scores.stat_strength    AS str,
                scores.stat_agility     AS agi
            FROM
                "   .$tbl.          " scores
            ORDER BY
                "   .$orderstat.    " ".$order."
            LIMIT
                "   .$limit;

        $stmt = $em->getConnection()->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();


        return $this->render('RendonanMiniBundle:Default:Pages/highscore.html.twig',
            array(
                'online'    => $sessionData["online"],
                'name'      => $sessionData["username"],

                'users'      => $results
            ));

    }

    public function scoresaveAction(Request $request)
    {
        $session = $request->getSession();

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

        //fetch data from POST-data received from game
        if ($request->isMethod('POST')) {

            /************************************
             * FETCH DATA FROM REQUEST
             */
            // data is an array with "name", "xp", "coins", "maxhp", "currenthp", "strength" and "agility" keys
            //$sessionData["username"] = $request->get('coins');
            $name       = $request->request->get('name');
            $xp         = $request->request->get('xp');
            $coins      = $request->request->get('coins');
            $maxhp      = $request->request->get('maxhp');
            $strength   = $request->request->get('strength');
            $agility    = $request->request->get('agility');

            //Init DB-Connection
            $em = $this->getDoctrine()->getManager();

            /************************************
             * STORE DATA INTO HIGHSCORE TABLE
             */
            //create new highscore object
            $score = new Highscore();

            //Insert received data into score object
            $score->setUsername($name);
            $score->setUserExperience($xp);
            $score->setUserCoins($coins);
            $score->setStatHp($maxhp);
            $score->setStatStrength($strength);
            $score->setStatAgility($agility);

            //persist object to database and save it
            $em->persist($score);
            $em->flush();

            /************************************
             * RESET USER DATA
             */
            //Init DB-Connection
            $repository = $em->getRepository('RendonanMiniBundle:Account');
            $user = $repository->findOneBy(array('username' => $session->get('username')));

            if ($user->getUsername() == $name)
            {
                $user->setUserExperience(0);
                $user->setUserCoins(0);
                $user->setStatHp(100);
                $user->setHp(100);
                $user->setStatStrength(1);
                $user->setStatAgility(0);

                $em->persist($user);
                $em->flush();
            }
        }
        return $this->redirect($this->generateUrl("rendonan_mini_registration"));
    }
}
