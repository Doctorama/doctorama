<?php

namespace DT\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DemoControllerTest extends WebTestCase
{
	private $client = null;
	
    public function setUp()
    {
        $this->client = static::createClient();
    }
	
	public function testSecuredAdmin()
    {
        $this->logInAdmin();

        $crawler = $this->client->request('GET', '/encadrant/doctorant_labo/creer_dossier_suivis');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Créer dossier de suivi")')->count());
    }
	
	private function logInAdmin()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'secured_area';
        $token = new UsernamePasswordToken('admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
	
	public function testSecuredUser()
    {
        $this->logInUser();

        $crawler = $this->client->request('GET', '/encadrant/doctorant_labo/creer_dossier_suivis');

        $this->assertFalse($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("")')->count());
    }
	private function logInUser()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'secured_area';
        $token = new UsernamePasswordToken('user', null, $firewall, array('ROLE_USER'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}