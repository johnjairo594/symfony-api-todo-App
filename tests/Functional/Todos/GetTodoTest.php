<?php

namespace App\Tests\Functional\Todos;

use App\Tests\Functional\Users\UserTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetTodoTest extends UserTestBase
{

    public function testGetTodo():void
    {
        self::$jeanpier->request('GET', '/api/v1/to_dos/'.self::getJeanpierTodoId()[0]);

        $response = self::$jeanpier->getResponse();
        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

    }
}