<?php

namespace Nz\TodoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoControllerTest extends WebTestCase
{
    public function testNewnote()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newNote');
    }

    public function testNewtodo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newTodo');
    }

    public function testPosttodos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postTodos');
    }

}
