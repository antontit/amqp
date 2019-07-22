<?php

declare(strict_types=1);

namespace Api\Http\Action;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Server\RequestHandlerInterface;

class HomeAction implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            'name' => 'App Api',
            'version' => '1.0'
        ]);
    }
}
