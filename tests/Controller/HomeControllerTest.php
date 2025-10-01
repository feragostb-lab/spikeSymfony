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
        
        // Check that multiple feature cards exist
        $this->assertGreaterThanOrEqual(6, $crawler->filter('.feature-card')->count());
        
        // Check for specific features
        $html = $crawler->html();
        $this->assertStringContainsString('RESTful API', $html);
        $this->assertStringContainsString('PWA Ready', $html);
        $this->assertStringContainsString('OpenAPI Documentation', $html);
    }
}
