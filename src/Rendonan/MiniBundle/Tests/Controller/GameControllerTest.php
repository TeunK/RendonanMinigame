<?php

namespace Rendonan\MiniBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{

    public function testNotLoggedIn()
    {
        $client = static::createClient();

        //OPEN REGISTRATION PAGE
        $crawler = $client->request('GET', '/game');
        $crawler = $client->followRedirect();
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Register:")')->count()
        );
    }

    //loadoffline -> register -> login -> loadgame -> savegame -> loadgame (new data) -> unregister -> logout
    public function testGame()
    {
        $username = "testuser";
        $password = "testpass";

        $client = static::createClient();

        //OPEN GAMELOAD URL, ATTEMPT TO RECEIVE USER DATA WHEN NOT LOGGED IN
        $crawler = $client->request('GET', '/gameload');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("LOCAL PLAYER;999999;999999;10000000;10000000;999999;0")')->count()
        );


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

        //OPEN GAMELOAD URL, ATTEMPT TO RECEIVE USER DATA WHEN LOGGED IN WITH NEWLY CREATED USER
        $crawler = $client->request('GET', '/gameload');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("'.$username.';0;0;100;100;1;0")')->count()
        );

        //UPDATE GAME DATA
        $client->request('POST', '/gamesave',
            array(
                'name'      => $username,
                'xp'        => '26326',
                'coins'     => '23473484',
                'maxhp'     => '123562437',
                'currenthp' => '472347',
                'strength'  => '23461',
                'agility'   => '9762'
            )
        );

        //OPEN GAMELOAD URL AGAIN, SEE IF USER DATA WAS INDEED UPDATED
        $crawler = $client->request('GET', '/gameload');
        //var_dump($client->getResponse()->getContent());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("'.$username.';26326;23473484;123562437;472347;23461;9762")')->count()
        );


        $crawler = $client->request('GET', '/main');
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
