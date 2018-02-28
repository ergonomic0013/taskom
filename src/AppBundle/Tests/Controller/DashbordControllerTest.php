<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashbordControllerTest extends WebTestCase
{
    public function testGraph()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/graph');
    }

}
