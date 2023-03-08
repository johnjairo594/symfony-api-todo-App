<?php

namespace App\Tests\Functional\Todos;

use App\Tests\Functional\Users\UserTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class EditTodoTest extends UserTestBase
{

    public function testEditTodo():void
    {
        $payload = [
            'name' => 'Todo test edit',
            'description' => 'Todo description test edit',
            'done' => true
        ];
        self::$jeanpier->request('PUT', '/api/v1/to_dos/'.self::getJeanpierTodoId()[0], [], [], [], json_encode($payload));

        $response = self::$jeanpier->getResponse();
        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }
}