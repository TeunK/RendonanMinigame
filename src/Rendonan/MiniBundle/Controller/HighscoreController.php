<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;
use Symfony\Component\HttpFoundation\Request;

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

}
