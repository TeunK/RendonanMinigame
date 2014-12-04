<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Teun
 * Date: 04/12/14
 * Time: 05:19
 * To change this template use File | Settings | File Templates.
 */

namespace Rendonan\MiniBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class HighscoreControllerTest extends WebTestCase {

    //register -> login -> savegame -> die -> testreset -> testhighscore -> removehighscore -> removeuser
    public function testSaveScore()
    {
        $username   = "testuser";
        $password   = "testpass";
        $xp         = "26326888";
        $coins      = "23473484";
        $maxhp      = "123562437";
        $currenthp  = "472347";
        $strength   = "23461";
        $agility    = "9762";

        $client = static::createClient();

        //OPEN REGISTRATION PAGE
        $crawler = $client->request('GET', '/register');

        //TEST IF USER IS SUCCESFULLY REGISTERED
        $form = $crawler->selectButton('account_confirm')->form();
        $form['account[username]'] = $username;
        $form['account[password]'] = $password;
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("'.$username.'")')->count()
        );

        //UPDATE GAME DATA
        $client->request('POST', '/gamesave',
            array(
                'name'      => $username,
                'xp'        => $xp,
                'coins'     => $coins,
                'maxhp'     => $maxhp,
                'currenthp' => $currenthp,
                'strength'  => $strength,
                'agility'   => $agility
            )
        );

        //PLAYER DIES, SCORE SAVED INTO HIGHSCORES
        $client->request('POST', '/scoresave',
            array(
                'name'      => $username,
                'xp'        => $xp,
                'coins'     => $coins,
                'maxhp'     => $maxhp,
                'strength'  => $strength,
                'agility'   => $agility
            )
        );
        //echo ($client->getResponse()->getContent());
        $crawler = $client->followRedirect();

        //TEST IF PLAYER STATS ARE RESET
        $crawler = $client->request('GET', '/gameload');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("'.$username.';0;0;100;100;1;0")')->count()
        );

        //TEST IF HIGHSCORE CONTAINS THIS PLAYER'S DATA
        $crawler = $client->request('GET', '/highscore');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("'.$maxhp.'")')->count()
        );

        //REMOVE ENTRY FROM HIGHSCORE
        $crawler = $client->request('GET', '/deletescore');

        //CONFIRM IF USER'S SCORE WAS REMOVED FROM DATABASE
        $crawler = $client->request('GET', '/highscore');
        $this->assertEquals(
            0,
            $crawler->filter('html:contains("'.$maxhp.'")')->count()
        );


        //TEST IF USER SUCCESFULLY UNREGISTERED
        $link = $crawler->selectLink('DELETE ACCOUNT')->link();
        $crawler = $client->click($link);
        $crawler = $client->followRedirect();
        $crawler = $client->followRedirect();
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("username:")')->count()
        );
    }
}
