<?php

declare(strict_types=1);

namespace Test\Feature\Author\Show;

use Test\Feature\WebTestCase;
use Test\Feature\AuthFixture;

class NoneTest extends WebTestCase
{
    protected function setUp(): void
    {
        $this->loadFixtures([
            'auth' => AuthFixture::class,
        ]);
        parent::setUp();
    }

    public function testGuest(): void
    {
        $response = $this->get('/author');
        self::assertEquals(401, $response->getStatusCode());
    }

    public function testSuccess(): void
    {
        $auth = $this->getAuth();
        $response = $this->get('/author', $auth->getHeaders());
        self::assertEquals(204, $response->getStatusCode());
    }

    private function getAuth(): AuthFixture
    {
        return $this->getFixture('auth');
    }
}
