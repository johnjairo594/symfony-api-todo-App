<?php

namespace App\Tests\Functional\Todos;

use App\Tests\Functional\Users\UserTestBase;
use Hautelook\AliceBundle\PhpUnit\RecreateDatabaseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserAddTodoTest extends UserTestBase
{
    use RecreateDatabaseTrait;
    public function testUserAddTodo():void
    {
        $payload = [
            'name' => 'Todo test',
            'description' => 'Todo test description'
        ];

        self::$jeanpier->request('POST', '/api/v1/user/add-todo', [], [], [], json_encode($payload));

        $response = self::$jeanpier->getResponse();

        $this->assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
    }

    public function testUserAddTodoWithMissingParameters():void
    {
        $payload = [
            'name' => 'Todo test',
        ];

        self::$jeanpier->request('POST', '/api/v1/user/add-todo', [], [], [], json_encode($payload));

        $response = self::$jeanpier->getResponse();

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testUserAddTodoWithEmptyParameters():void
    {
        $payload = [
            'name' => '  ',
            'description' => 'Todo test description'
        ];

        self::$jeanpier->request('POST', '/api/v1/user/add-todo', [], [], [], json_encode($payload));

        $response = self::$jeanpier->getResponse();

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}