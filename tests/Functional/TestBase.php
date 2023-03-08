<?php

namespace App\Tests\Functional;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Hautelook\AliceBundle\PhpUnit\RecreateDatabaseTrait;
use src\Infrastructure\Repository\UserRepository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TestBase extends WebTestCase
{
    use RecreateDatabaseTrait;

    protected static ?KernelBrowser $client = null;
    protected static ?KernelBrowser $jeanpier = null;

    protected function setUp():void
    {
        if (null === self::$client) {
            self::$client = static::createClient();
            self::$client->setServerParameters([
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/ld+json'
            ]);
        }

        if (null === self::$jeanpier) {
            self::$jeanpier = clone self::$client;
            $this->createAuthenticatedUser(self::$jeanpier, 'jeanpier@todo.com');
        }
    }

    private function createAuthenticatedUser(KernelBrowser &$client, string $email):void
    {
        $user = $this->getContainer()->get('src\Infrastructure\Repository\UserRepository\UserRepository')->findOneByEmailOrFail($email);
        $token = $this
            ->getContainer()
            ->get('Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface')
            ->create($user);

        $client->setServerParameters([
            'HTTP_Authorization' => sprintf('Bearer %s', $token),
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/ld+json'
        ]);
    }

    protected function getResponseData(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }

    protected function initDbConnection(): Connection
    {
        return $this->getContainer()->get('doctrine')->getConnection();
    }

    /**
     * @throws Exception
     */
    protected function getJeanpierId()
    {
        return $this->initDbConnection()->executeQuery('SELECT id FROM user WHERE email ="jeanpier@todo.com"')->fetchFirstColumn();
    }

    /**
     * @throws Exception
     */
    protected function getJeanpierTodoId()
    {
        return $this->initDbConnection()->executeQuery('SELECT id FROM todo WHERE name ="Todo name test"')->fetchFirstColumn();
    }
}