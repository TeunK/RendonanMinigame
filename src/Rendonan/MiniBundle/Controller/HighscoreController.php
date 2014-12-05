<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;
use Symfony\Component\HttpFoundation\Request;
use Rendonan\MiniBundle\Entity\Highscore;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class HighscoreController extends Controller
{
    public function indexAction(Request $request)
    {
        //INITIALISE SESSION
        $session        = new GetSession($this->get('session'));
        $sessionData    = $session->getData();

        //FETCH GET-INPUT
        $orderstat      = $request->get("stat");
        $order          = $request->get("order");
        $user           = $request->get("_username");
        $filterstat     = $orderstat;
        $filterorder    = $order;
        $filteruser     = $user;

        //DEFINE STAT FILTER FOR DB-QUERY
        switch ($orderstat)
        {
            case "xp":
                $orderstat = "xp";
                break;
            case "wealth":
                $orderstat = "coins";
                break;
            case "health":
                $orderstat = "hp";
                break;
            case "strength":
                $orderstat = "str";
                break;
            case "agility":
                $orderstat = "agi";
                break;
            default:
                $orderstat = "score DESC, xp";
                break;
        }

        //DEFINE ORDER FILTER FOR DB-QUERY
        switch ($order)
        {
            case "0":
                $order = "ASC";
                break;
            default:
                $order = "DESC";
                break;
        }

        //IF USER-BASED SEARCH SPECIFIED, ADD WHERE-CLAUSE TO SELECTION
        $WHERE = "";
        if ($user != "") { $WHERE = "WHERE scores.username = '".$user."' "; }

        $limit = 20;

        //EXECUTE DB-QUERY
        $em = $this->getDoctrine()->getManager();
        $tbl = $em->getClassMetadata('RendonanMiniBundle:Highscore')->getTableName();
        $query = "
            SELECT
                scores.username         AS user,
                scores.user_score       AS score,
                scores.user_experience  AS xp,
                scores.user_coins       AS coins,
                scores.stat_hp          AS hp,
                scores.stat_strength    AS str,
                scores.stat_agility     AS agi
            FROM
                "   .$tbl.          " scores
            $WHERE
            ORDER BY
                "   .$orderstat.    " ".$order."
            LIMIT
                "   .$limit;

        //EXECUTE DB-QUERY
        $stmt = $em->getConnection()->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();


        //$repository = $this->getDoctrine()->getRepository('RendonanMiniBundle:Highscore');
        //$results = $repository->findAll();
        //echo $results;

        //RENDER HTML WEBPAGE
        return $this->render('RendonanMiniBundle:Default:Pages/highscore.html.twig',
            array(
                'online'        => $sessionData["online"],
                'name'          => $sessionData["username"],

                'filter_stat'   => $filterstat,
                'filter_order'  => $filterorder,
                'filter_user'   => $filteruser,
                'users'         => $results
            ));

    }

    public function scoresaveAction(Request $request)
    {
        $session = $request->getSession();

        //bypass SSX security issues that would otherwise occur in certain browsers when trying to connect game using http_get():
        //this allows cross-domain access to happen
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin','*');
        $response->send();

        //fetch data from POST-data received from game
        if ($request->isMethod('POST'))
        {

            //FETCH DATA FROM REQUEST
            $name       = $request->request->get('name');
            $xp         = $request->request->get('xp');
            $coins      = $request->request->get('coins');
            $maxhp      = $request->request->get('maxhp');
            $strength   = $request->request->get('strength');
            $agility    = $request->request->get('agility');
            //calculate score
            $userscore  = min((floor($xp/40)+floor($coins/20)+floor($maxhp/10)+$strength+$agility),999999999);


            //INITIALIZE DB-CONNECTION
            $em = $this->getDoctrine()->getManager();

            //STORE NEW HIGHSCORE OBJECT DATA INTO HIGHSCORE TABLE
            $score = new Highscore();

            //Insert received data into score object
            $score->setUsername($name);
            $score->setScore($userscore);
            $score->setUserExperience($xp);
            $score->setUserCoins($coins);
            $score->setStatHp($maxhp);
            $score->setStatStrength($strength);
            $score->setStatAgility($agility);

            //persist object to database and save it
            $em->persist($score);
            $em->flush();


            //RESET USER GAME DATA
            //INITIALIZE DB-CONNECTION
            $repository = $em->getRepository('RendonanMiniBundle:Account');
            $user = $repository->findOneBy(array('username' => $session->get('username')));

            //UPDATE ACCOUNT DATABASE: reset user account stats
            if ($user->getUsername() == $name)
            {
                //prepare data
                $user->setUserExperience(0);
                $user->setUserCoins(0);
                $user->setStatHp(100);
                $user->setHp(100);
                $user->setStatStrength(1);
                $user->setStatAgility(0);

                //persist and execute query
                $em->persist($user);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl("rendonan_mini_registration"));
    }

    public function removescoreAction()
    {
        //get the logged-in-user from database
        $getSession        = new GetSession($this->get('session'));
        $getSessionData    = $getSession->getData();

        if ($getSessionData["online"])
        {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('RendonanMiniBundle:Highscore');

            $username = $getSessionData["username"];
            $scores = $repository->findBy(array('username' => $username));

            //remove all scores from the user from the highscore table
            foreach ($scores as $score)
            {
                $em->remove($score);
            }
            $em->flush();

            return $this->redirect($this->generateUrl("rendonan_mini_homepage"));
        }
        else
        {
            return $this->redirect($this->generateUrl("rendonan_mini_homepage"));
        }
    }
}
