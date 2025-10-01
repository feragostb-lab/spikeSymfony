<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomePageIsSuccessful(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Welcome to Symfony PWA Bootstrap');
    }

    public function testHomePageContainsPWAFeatures(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.feature-card');
        $this->assertSelectorTextContains('h3', 'RESTful API');
        $this->assertSelectorTextContains('h3', 'PWA Ready');
    }
}
