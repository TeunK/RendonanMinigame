<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;
use Symfony\Component\HttpFoundation\Request;
use Rendonan\MiniBundle\Entity\Highscore;

class HighscoreController extends Controller
{
    public function indexAction(Request $request)
    {
        //INITIALISE SESSION
        $session        = new GetSession();
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

        //IF NO USER SPECIFIED, TRANSLATE INTO * FOR DB-QUERY
        $WHERE = "";
        if ($user != "") { $WHERE = "WHERE scores.username = '".$user."' "; }

        //FETCH POST(-username) INPUT


        //PREPARE DB-QUERY TO RECEIVE HIGHSCORES
        $em = $this->getDoctrine()->getManager();
        $tbl = $em->getClassMetadata('RendonanMiniBundle:Highscore')->getTableName();
        $limit = 100;
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
            //if HTTP_ORIGIN is not set, allow any origin (priority on working game rather than security for now)
            header('Access-Control-Allow-Origin: *');
        }

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
            $userscore  = (($xp + $coins + 1) * ceil($maxhp/10) * ceil($strength+1) * ceil($agility+1));

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
}
