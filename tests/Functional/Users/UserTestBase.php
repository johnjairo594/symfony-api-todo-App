<?php

namespace App\Tests\Functional\Users;

use App\Tests\Functional\TestBase;

class UserTestBase extends TestBase
{
    protected string $endpoint;

    protected function setUp():void
    {
        parent::setUp();

        $this->endpoint = '/api/v1/users';
    }
}