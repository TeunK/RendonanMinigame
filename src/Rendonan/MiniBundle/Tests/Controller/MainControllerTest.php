<?php

namespace Rendonan\MiniBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class MainControllerTest extends WebTestCase
{
    public function testEmptyPage()
    {
        $client = static::createClient();

        //TEST IF PAGE AUTO FORWARDS WHEN NO PAGE IS SPECIFIED
        $crawler = $client->request('GET', '/');
        $crawler = $client->followRedirect();
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("PLAY MINIGAME")')->count()
        );
    }
}
