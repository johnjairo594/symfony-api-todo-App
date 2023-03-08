<?php

namespace App\Tests\Functional\Todos;

use App\Tests\Functional\Users\UserTestBase;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteTodoTest extends UserTestBase
{
    /**
     * @throws Exception
     */
    public function testDeleteTodo():void
    {
        self::$jeanpier->request('DELETE', '/api/v1/to_dos/'.self::getJeanpierTodoId()[0]);

        $response = self::$jeanpier->getResponse();
        $this->assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());

    }

}