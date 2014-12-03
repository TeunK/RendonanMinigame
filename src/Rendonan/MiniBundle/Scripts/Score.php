<?php

namespace Rendonan\MiniBundle\Scripts;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;


class Score
{
    public function getScores($WHERE,$orderstat,$order,$limit)
    {
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
        return $results;
    }
}