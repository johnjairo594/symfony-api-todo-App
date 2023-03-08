<?php

namespace App\Tests\Functional\Users;

use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginTest extends UserTestBase
{
    public function testLogin(): void
    {
        $payload = [
            'username' => 'jeanpier@todo.com',
            'password' => 'password'
        ];

        self::$jeanpier->request('POST', sprintf('%s/login_check', $this->endpoint), [], [], [], json_encode($payload));

        $response = self::$jeanpier->getResponse();

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(JWTAuthenticationSuccessResponse::class, $response->isSuccessful());
    }

    public function testLoginWithInvalidPassword(): void
    {
        $payload = [
            'username' => 'jeanpier@todo.com',
            'password' => 'invalid-password'
        ];

        self::$jeanpier->request('POST', sprintf('%s/login_check', $this->endpoint), [], [], [], json_encode($payload));

        $response = self::$jeanpier->getResponse();

        $this->assertEquals(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertInstanceOf(JWTAuthenticationFailureResponse::class, $response);
    }
}