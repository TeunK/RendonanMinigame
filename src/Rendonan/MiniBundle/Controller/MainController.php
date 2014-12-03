<?php

namespace Rendonan\MiniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Scripts\GetSession;

class MainController extends Controller
{
    public function indexAction()
    {
        //Fetch highscore list

        $em = $this->getDoctrine()->getManager();
        $tbl = $em->getClassMetadata('RendonanMiniBundle:Highscore')->getTableName();
        $orderstat = "score";
        $order     = "DESC";
        $limit = 10;
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
            ORDER BY
                "   .$orderstat.    " ".$order."
            LIMIT
                "   .$limit;

        //EXECUTE DB-QUERY
        $stmt = $em->getConnection()->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $session        = new GetSession();
        $sessionData    = $session->getData();
        return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
            array(
                'online'    => $sessionData["online"],
                'name'      => $sessionData["username"],
                'users'     => $results
            ));
    }

}
