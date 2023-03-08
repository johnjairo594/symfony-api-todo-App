<?php

namespace App\Tests\Functional\Users;

use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterTest extends UserTestBase
{
    public function testRegister():void
    {
        $payload = [
            "name" => "Alex",
            "email" => "alex@todo.com",
            "password" => "password"
        ];

        self::$client->request('POST', sprintf('%s/register', $this->endpoint), [], [], [], json_encode($payload));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals($payload['email'], $responseData['email']);

        }

    public function testRegisterWithMissingParameters():void
    {
        $payload = [
            "name" => "Alex",
            "password" => "password"
        ];

        self::$client->request('POST', sprintf('%s/register', $this->endpoint), [], [], [], json_encode($payload));

        $response = self::$client->getResponse();

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testRegisterWithInvalidPassword():void
    {
        $payload = [
            "name" => "Alex",
            "email" => "alex@todo.com",
            "password" => "123"
        ];

        self::$client->request('POST', sprintf('%s/register', $this->endpoint), [], [], [], json_encode($payload));

        $response = self::$client->getResponse();

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}