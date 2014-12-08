<?php

namespace Rendonan\MiniBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class MainControllerTest extends WebTestCase
{
    public function testEmptyUrl()
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

    public function test404Page()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/23og2l3kja');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("404")')->count()
        );

        //TEST IF PAGE AUTO FORWARDS WHEN NO PAGE IS SPECIFIED
        $crawler = $client->request('GET', '/123/456/abc/def/xyz');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("404")')->count()
        );
    }
}
