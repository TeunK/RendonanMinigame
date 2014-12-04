<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Teun
 * Date: 03/12/14
 * Time: 16:07
 * To change this template use File | Settings | File Templates.
 */

namespace Rendonan\MiniBundle\Tests\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

class RegisterControllerTest extends WebTestCase {

    public function testLoginFail()
    {
        $client = static::createClient();

        //TEST REGISTER/LOGIN PAGE LOADED
        $crawler = $client->request('GET', '/register');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Register:")')->count()
        );

        //TEST IF USER IS FORWARDED TO ERROR MESSAGE FOR WRONG CREDENTIALS
        $form = $crawler->selectButton('user_login')->form();
        $form['_username'] = "nonexistinguser";
        $form['_password'] = "nonexistingpass";
        $crawler = $client->submit($form);
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Error,")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("username and password do not match.")')->count()
        );

        //TEST INVALID INPUT WAS GIVEN FOR FORM
        $form = $crawler->selectButton('user_login')->form();
        $form['_username'] = "\"!)(%*)";
        $form['_password'] = "!#%*&@(\'!@";
        $crawler = $client->submit($form);
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Error,")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Invalid input used for username / password: Must be alphanumeric with length 4 - 20 characters.")')->count()
        );

        //TEST INVALID INPUT WAS GIVEN FOR FORM
        $form = $crawler->selectButton('user_login')->form();
        $form['_username'] = "a";
        $form['_password'] = "a";
        $crawler = $client->submit($form);
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Error,")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Invalid input used for username / password: Must be alphanumeric with length 4 - 20 characters.")')->count()
        );

        // var_dump($client->getResponse()->getContent());
    }

    public function testRegister()
    {
        $client = static::createClient();

        //OPEN REGISTRATION PAGE
        $crawler = $client->request('GET', '/register');

        //TEST IF USER IS SUCCESFULLY REGISTERED
        $form = $crawler->selectButton('account_confirm')->form();
        $form['account[username]'] = "testuser";
        $form['account[password]'] = "testpass";
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("testuser")')->count()
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
